<?php

namespace App\Http\Controllers;

use App\Models\Compain;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Services\CompainService;

class CompainController extends Controller
{
    protected $compainService;

    public function __construct(CompainService $compainService)
    {
        $this->compainService = $compainService;
    }

    /**
     * Display a listing of the resource.
     * @param Request
     * @return Response
     */
    public function index(Request $request)
    {
        return response()->json(['compains' => $request->user()->compains]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        return $this->compainService->createCompain($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  Compain $compain
     * @return Response
     */
    public function show(Compain $compain)
    {
        return response()->json(['compain' => $compain]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Compain  $compain
     * @return Response
     */
    public function update(Request $request, Compain $compain)
    {
        return $this->compainService->updateCompain($request, $compain);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Compain $compain
     * @return Response
     */
    public function destroy(Compain $compain)
    {
        return $this->compainService->deleteCompain($compain);
    }
}
