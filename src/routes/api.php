<?php

use App\Http\Controllers\JobOpportunityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/jobs-opportunities', [JobOpportunityController::class, 'index']);
Route::post('/jobs-opportunities',[JobOpportunityController::class, 'store']);
