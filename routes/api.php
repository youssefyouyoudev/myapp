<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('cards', CardController::class);
    Route::post('cards/{card}/block', [CardController::class, 'block']);
    Route::post('cards/{card}/unblock', [CardController::class, 'unblock']);
});
