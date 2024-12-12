<?php

use App\Http\Controllers\JobOpportunityController;
use Illuminate\Support\Facades\Route;

Route::get('/job-opportunities/search',[JobOpportunityController::class, 'search']);
Route::get('/job-opportunities',[JobOpportunityController::class, 'index']);
Route::post('/job-opportunities',[JobOpportunityController::class, 'store']);
