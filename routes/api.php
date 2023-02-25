<?php

use App\Http\Controllers\API\GameController;
use App\Http\Requests\GameRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::get('game', [GameController::class, 'get'])->name('get-game');
Route::get('game/{id_game?}', [GameController::class, 'get']);
Route::post('game', [GameController::class, 'store']);
Route::put('game/{id_game?}', [GameController::class, 'update']);
Route::delete('game/{id_game?}', [GameController::class, 'destroy']);
