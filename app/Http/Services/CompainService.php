<?php

namespace App\Http\Services;

use DateTime;
use App\Models\Compain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompainService
{

    /**
     * Create compain service
     *
     * @param Request $request
     * @return Array
     */
    public function createCompain(Request $request)
    {
        $isValid = $this->validate($request, [
            'name' => 'required',
            'date_from' => 'required|date|after_or_equal:today',
            'date_to' => 'required|date|after:date_from',
            'daily_budget' => 'required',
        ]);

        if (isset($isValid['errors'])) {
            return $isValid;
        }

        $totalBudget = $this->getTotalBudget($request->compain);
        $creatives = isset($request->compain['creative_upload']) ? $request->compain['creative_upload'] : [];

        $newCompain = new Compain();
        $newCompain->user_id = $request->compain['user_id']; //Auth::id()
        $newCompain->name = $request->compain['name'];
        $newCompain->date_from = $request->compain['date_from'];
        $newCompain->date_to = $request->compain['date_to'];
        $newCompain->daily_budget = $request->compain['daily_budget'];
        $newCompain->total_budget = $totalBudget;
        $newCompain->creative_upload = json_encode($creatives);

        $newCompain->save();

        return ['compain' => $newCompain];
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param Compain $compain
     * @return array
     */
    public function updateCompain(Request $request, Compain $compain)
    {
        $newCompain = $request->compain;

        // name
        if (isset($newCompain['name'])) {
            $compain->name = $newCompain['name'];
        }

        // Daily budget
        if (isset($newCompain['daily_budget'])) {
            $compain->daily_budget = $newCompain['daily_budget'];
        }

        // Creative uploads
        if (isset($newCompain['creative_upload'])) {
            $compain->creative_upload = $newCompain['creative_upload'];
        }

        // check for new date from
        if (isset($newCompain['date_from'])) {
            $isValid = $this->validate($request, ['date_from' => 'date|after_or_equal:today']);
            if (isset($isValid['errors'])) {
                return $isValid;
            }

            $compain->date_from = $newCompain['date_from'];
        }

        // check for new date to
        if (isset($newCompain['date_to'])) {
            $isValid = $this->validate($request, ['date_to' => 'date|after:date_from']);
            if (isset($isValid)) {
                return $isValid;
            }

            $compain->date_to = $newCompain['date_to'];
        }

        // Update compain budget
        $compain->total_budget = $this->getTotalBudget($compain->toArray());

        // Save updated compain
        $compain->save();

        return ["compain" => $compain];
    }

    /**
     * Delete compain
     *
     * @param Compain $compain
     * @return Array
     */
    public function deleteCompain(Compain $compain)
    {
        $compain->delete();

        return ['success' => "Compain deleted successfuly"];
    }

    /**
     * Get compain total budget
     *
     * @param Array $compain
     * @return Double
     */
    private function getTotalBudget(array $compain)
    {
        $to = new DateTime($compain['date_to']);
        $from = new DateTime($compain['date_from']);
        $diff = $from->diff($to);
        return $diff->days * $compain['daily_budget'];
    }


    /**
     * Validate compains data.
     *
     * @param Request $request
     * @param array $fieldRules
     * @return Array
     */
    private function validate(Request $request, array $fieldRules)
    {
        $validator =  Validator::Make($request->compain, $fieldRules);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()->getMessages()];
        }

        return [ 'success' => true];
    }
}
