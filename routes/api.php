<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomFacilityController;

Route::middleware('auth:api')->group(function () {
    Route::apiResource('hotels', HotelController::class);
    Route::apiResource('room-facilities', RoomFacilityController::class);
});
