<?php

namespace App\Http\Services;

use DateTime;
use App\Models\Compain;
use Illuminate\Support\Facades\Auth;

class CompainService {

    /**
     * Create compain service
     * 
     * @param Array $compain 
     * @return Compain $compain
     */
    public function createCompain(Array $compain) 
    {
        $to = new DateTime($compain['date_to']);
        $from = new DateTime($compain['date_from']);
        $diff = $from->diff($to);
        $totalBudget = $diff->days * $compain['daily_budget'];

        $newCompain = new Compain();
        $newCompain->user_id = $compain['user_id']; //Auth::id()
        $newCompain->name = $compain['name'];
        $newCompain->date_from = $compain['date_from'];
        $newCompain->date_to = $compain['date_to'];
        $newCompain->daily_budget = $compain['daily_budget'];
        $newCompain->total_budget = $totalBudget;
        $newCompain->creative_upload = json_encode($compain['creative_upload']);

        $newCompain->save();

        return $newCompain;
    }
}