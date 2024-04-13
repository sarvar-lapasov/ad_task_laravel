<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;
use App\Http\Controllers\AdPhotoController;



Route::apiResources([
    'ads' => AdController::class,
    'ads.photos' => AdPhotoController::class,
]);