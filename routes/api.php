<?php

use App\Http\Controllers\Api\FlightController;
use App\Http\Controllers\Api\ItineraryController;
use App\Http\Controllers\Api\PassengerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(ItineraryController::class)->group(function () {
    Route::get('/itineraries', 'index');
    Route::post('/itinerary', 'store');
});

Route::controller(FlightController::class)->group(function () {
    Route::get('/flights', 'index');
    Route::post('/flight', 'store');
});

Route::controller(PassengerController::class)->group(function () {
    Route::get('/passengers', 'index');
    Route::post('/passenger', 'store');
});