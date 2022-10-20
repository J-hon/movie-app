<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\MovieController;
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

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthenticationController::class, 'login']);
    Route::post('signup', [AuthenticationController::class, 'signup']);
    Route::post('logout', [AuthenticationController::class, 'logout']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('movies')->group(function () {
        Route::get('', [MovieController::class, 'index']);

        Route::prefix('list')->group(function () {
            Route::get('', [MovieController::class, 'fetch']);
            Route::post('add', [MovieController::class, 'add']);
            Route::delete('remove', [MovieController::class, 'remove']);
        });
    });
});
