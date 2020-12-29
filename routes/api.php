<?php

use App\Http\Controllers\UserController;
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

Route::group(['prefix' => 'users'], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('{id}', [UserController::class, 'show'])->where('id', '[0-9]+');
    Route::get('{id}/transactions', [UserController::class, 'transactions'])->where('id', '[0-9]+');
    Route::post('{id}/transactions', [UserController::class, 'sendTransaction'])->where('id', '[0-9]+');
});

