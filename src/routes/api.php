<?php

use App\Http\Controllers\JobOpportunityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/job-opportunities/search',[JobOpportunityController::class, 'search']);
Route::apiResource('/job-opportunities', JobOpportunityController::class);
