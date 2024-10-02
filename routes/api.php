<?php

use App\Http\Controllers\Api\V1\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/profile/personal/{id}', [ProfileController::class, 'show']);
Route::post('/profile/personal/{id}', [ProfileController::class, 'update']);
