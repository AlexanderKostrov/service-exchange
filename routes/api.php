<?php

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

Route::post('register', 'API\AuthController@register');
Route::post('login', 'API\AuthController@login');

Route::middleware('auth:api')->group(function () {

    Route::group(['prefix' => 'order'], function() {
        Route::get('/create', 'API\OrderController@create');
        Route::get('/done/{id}', 'API\OrderController@done');
    });

    Route::group(['prefix' => 'bid'], function() {
        Route::get('/create/{id}', 'API\BidController@create');
        Route::get('/approve/{id}', 'API\BidController@approve');
    });

});
