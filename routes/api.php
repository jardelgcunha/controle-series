<?php

use App\Http\Controllers\Api\SeasonsController;
use App\Http\Controllers\Api\SeriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('/series', SeriesController::class);

Route::get('/series/{series}/seasons', [SeasonsController::class, 'show']);

Route::get('/series/{series}/episodes', [SeriesController::class, 'getEpisodes']);
