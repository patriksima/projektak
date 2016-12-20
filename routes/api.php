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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['prefix' => 'chat'], function () {
    Route::get('{channel}', 'ChatMessageController@index');
    Route::post('', 'ChatMessageController@store');
});

/*
|--------------------------------------------------------------------------
| Task resource routes
|--------------------------------------------------------------------------
|
| All routes associated with the resource are specified below.
|
*/

Route::get('tasks/forUser', 'TaskController@forUser');
Route::get('tasks/logs', 'TaskController@logs');
Route::get('tasks/running', 'TaskController@running');
Route::get('tasks/total/{period}', 'TaskController@total');
Route::post('tasks/request', 'TaskController@request');
Route::put('tasks/{task}/start', 'TaskController@start');
Route::put('tasks/{task}/stop', 'TaskController@stop');
