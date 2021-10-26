<?php

namespace App\Http\Controllers;

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
     * @return Response
     */
    public function index(Request $request)
    {
        if (!$request->id) {
            return $this->compainService->getAllCompains();
        }

        return $this->compainService->getCompain($request->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $compain = $this->compainService->createCompain($request);
        return response()->json($compain, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        return $this->compainService->updateCompain($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function destroy(Request $request)
    {
        return $this->compainService->deleteCompain($request->id);
    }

    /**
     * Handle uploads
     *
     * @param Request $request
     * @return Response
     */
    public function upload(Request $request)
    {
        return $this->compainService->upload($request);
    }
}
