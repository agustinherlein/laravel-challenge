<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('status', function(){
    return 'ok';
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
