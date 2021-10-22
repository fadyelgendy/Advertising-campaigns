<?php

use App\Http\Controllers\CompainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Get Compains 
Route::get("/compains", [CompainController::class, 'index']);
Route::prefix('/compain')->group(function() {
    Route::get('/{compain}', [CompainController::class, 'show']);
    Route::post("/store", [CompainController::class, 'store']);
    Route::post("/{compain}", [CompainController::class, 'update']);
    Route::delete("/{compain}", [CompainController::class, 'destroy']);
});
