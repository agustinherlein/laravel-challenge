<?php

use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('status', function(){
    return 'ok';
})->middleware('auth:sanctum');

Route::apiResource('orders', OrderController::class);

// Auth routes
Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);
 
    return ['token' => $token->plainTextToken];
});
