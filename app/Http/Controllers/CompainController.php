<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
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
    public function index()
    {
        return $this->compainService->getAllCompains();
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
     * Display the specified resource.
     *
     * @param  Request $request
     * @return Response
     */
    public function edit(Request $request)
    {
        return $this->compainService->getCompain($request->id);
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
    public function upload(Request $request): JsonResponse
    {
        return $this->compainService->upload($request);
    }
}
