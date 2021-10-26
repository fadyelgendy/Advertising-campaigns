<?php

namespace App\Http\Services;

use DateTime;
use App\Models\Compain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CompainService
{
    /**
     * get all campaigns related to logged user
     *
     * @return void
     */
    public function getAllCompains()
    {
        $results = Compain::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        $compains = array();
        foreach ($results as $result) {
            $compains[] = $this->formatOutput($result);
        }

        return response()->json(['compains' => $compains]);
    }

    public function getCompain($id)
    {
        $result = Compain::find($id);
        $compain = $this->formatOutput($result);

        if ($compain) {
            return response()->json(['compain' => $compain], 200);
        }

        return response()->json(['message' => "Not Found!" ], 404);
    }

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

        $totalBudget = $this->getTotalBudget($request->all());

        $newCompain = new Compain();
        $newCompain->user_id = Auth::id();
        $newCompain->name = $request->name;
        $newCompain->date_from = $request->date_from;
        $newCompain->date_to = $request->date_to;
        $newCompain->daily_budget = $request->daily_budget;
        $newCompain->total_budget = $totalBudget;
        $newCompain->creative_upload = json_encode($request->creative_upload);

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
    public function updateCompain(Request $request)
    {
        $newCompain = $request->all();
        $compain = Compain::find($newCompain["id"]);

        if (!$compain) {
            return [
                "success" => 0,
                "message" => "Not Found!"
            ];
        }

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
            $compain->creative_upload = json_encode($newCompain['creative_upload']);
        }

        // check for new date from
        if (isset($newCompain['date_from']) && $newCompain['date_from'] != $compain->date_from) {
            $isValid = $this->validate($request, ['date_from' => 'date|after_or_equal:today']);
            if (isset($isValid['errors'])) {
                return $isValid;
            }

            $compain->date_from = $newCompain['date_from'];
        }

        // check for new date to
        if (isset($newCompain['date_to']) && $newCompain['date_to'] != $compain->date_to) {
            $isValid = $this->validate($request, ['date_to' => 'date|after:date_from']);
            if (isset($isValid['errors'])) {
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
    public function deleteCompain($id)
    {
        $compain = Compain::find($id);
        if (!$compain) {
            return ['success' => 0, "message" => "Compain deleted successfuly"];
        }

        $creatives = json_decode($compain->creative_upload);
        Storage::delete($creatives);
        $compain->delete();

        return ['success' => "Compain deleted successfuly"];
    }

    /**
     * Upload creatives
     *
     * @param Request $request
     * @return void
     */
    public function upload(Request $request)
    {
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $filename = str_replace(" ", '', $filename);
        $path = $file->storeAs('uploads', $filename);

        // Failed
        if (!$path) {
            return response()->json([
                'success' => false,
                'message' => "Upload failed"
            ], 503);
        }

        // success
        return response()->json([
            'success' => true,
            'path' => $path
        ], 200);
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
        return $diff->days * floatval($compain['daily_budget']);
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
        $validator =  Validator::Make($request->all(), $fieldRules);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()->getMessages()];
        }

        return [ 'success' => true];
    }

    /**
     * format data for request
     *
     * @param mixed $data
     * @return void
     */
    private function formatOutput($data)
    {
        $creatives = array_map(function ($img) {
            return asset("storage/" . $img);
        }, json_decode($data->creative_upload));

        return [
            "id" => $data->id,
            "user_id" => $data->user_id,
            "name" => $data->name,
            "date_from" => $data->date_from,
            "date_to" => $data->date_to,
            "daily_budget" => number_format($data->daily_budget, 2),
            "total_budget" => number_format($data->total_budget, 2),
            "creative_upload" => $creatives,
            "created_at" => date_format($data->created_at, "Y-m-d")
        ];
    }
}
