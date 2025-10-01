<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LocationController;


Route::get('/locations/districts', [LocationController::class, 'districts']); // ?province_id=
Route::get('/locations/wards',     [LocationController::class, 'wards']);  // ?district_id=
