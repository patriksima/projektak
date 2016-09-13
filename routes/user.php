<?php

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middleware' => ['web', 'auth', 'role:worker'], 'prefix' => 'user'], function () {
    Route::group(['prefix' => 'tasks'], function () {
        Route::get('/', 'User\TaskController@index');
        Route::post('/', 'User\TaskController@store');
        Route::post('update/{id}', 'User\TaskController@update');
        Route::get('delete/{id}', 'User\TaskController@destroy');
        Route::get('edit/{id}', 'User\TaskController@edit');
    });
    Route::get('/', 'User\DashboardController@index');

    Route::group(['prefix' => 'api'], function () {
        Route::group(['prefix' => 'task'], function () {
            Route::post('/start', 'User\TaskController@apiStart');
            Route::post('/stop', 'User\TaskController@apiStop');
        });
        Route::group(['prefix' => 'tasks'], function () {
            Route::get('/', 'User\TaskController@apiIndex');
        });
    });
});
