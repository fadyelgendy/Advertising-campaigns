<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompainController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public Routes
Route::post('/login', [AuthController::class, "login"]);
Route::post('/register', [AuthController::class, "register"]);
Route::post('/logout', [AuthController::class, "logout"])->middleware("auth:sanctum");

// Private routes
Route::group(['prefix'=> 'compain'], function() { 
    Route::get("/", [CompainController::class, 'index']);
    Route::get('/{compain}', [CompainController::class, 'show']);
    Route::post("/store", [CompainController::class, 'store']);
    Route::post("/{compain}", [CompainController::class, 'update']);
    Route::delete("/{compain}", [CompainController::class, 'destroy']);
});
