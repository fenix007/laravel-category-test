<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('product', '\App\Http\Controllers\Api\ProductController');

Route::get('category-hierarchy', '\App\Http\Controllers\Api\CategoryController@hierarchy');
Route::apiResource('category', '\App\Http\Controllers\Api\CategoryController');

