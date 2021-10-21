<?php

namespace App\Http\Controllers;

use App\Http\Services\CompainService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompainController extends Controller
{
    protected $compainService;

    public function __construct(CompainService $compainService)
    {
        $this->compainService = $compainService;    
    }

    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $compains = $request->user()->compains;

        return response()
        ->json([
            'compains' => $compains
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validdate request
        $validator = Validator::make($request->compain, [
            'name' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'daily_budget' => 'required',
        ]);

        if (!$validator) {
            return response()
                ->json([
                    "error" => $validator
                ]);
        }

        $compain = $this->compainService->createCompain($request->compain);

        return response()
        ->json([
            'compain' => $compain
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompainController  $compainController
     * @return \Illuminate\Http\Response
     */
    public function show(CompainController $compainController)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompainController  $compainController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompainController $compainController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompainController  $compainController
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompainController $compainController)
    {
        //
    }
}
