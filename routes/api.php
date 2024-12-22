<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('status', function () {
    return 'ok';
});

Route::apiResource('orders', OrderController::class)->middleware('auth:sanctum');

Route::prefix('auth')->name('auth.')->controller(AuthController::class)->group(function () {
    Route::post('register', 'register')->name('register');
    Route::post('login', 'login')->name('login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', 'logout')->name('logout');
    });
});