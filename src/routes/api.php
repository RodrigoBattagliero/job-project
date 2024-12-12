<?php

use App\Http\Controllers\JobOpportunityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('/job-opportunities', JobOpportunityController::class);
//Route::post('/job-opportunities','JobOpportunityController@store');
