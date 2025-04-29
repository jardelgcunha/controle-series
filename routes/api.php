<?php

use App\Http\Controllers\Api\SeasonsController;
use App\Http\Controllers\Api\SeriesController;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('/series', SeriesController::class);

Route::get('/series/{series}/seasons', [SeasonsController::class, 'show']);

Route::get('/series/{series}/episodes', [SeriesController::class, 'getEpisodes']);

Route::patch('/episodes/{episode}', function (Episode $episode, Request $request) {
    $episode->watched = $request->watched;
    $episode->save();
    
    return $episode;
});
