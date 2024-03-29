<?php

use App\Http\Controllers\Api\TrackController;
use App\Http\Controllers\Api\PlaylistController;
use App\Http\Controllers\ApikeyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tracks', [TrackController::class, 'index']);
Route::middleware('User')->get('/playlists', [PlaylistController::class, 'index']);