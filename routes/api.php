<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/user', 'UserAuthController');

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::resource('products', 'ProductController');
});


