<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Social Auth
Route::auth();

Route::get('auth/{provider}', 'SocialAuthController@redirect');
Route::get('auth/{provider}/callback', 'SocialAuthController@callback');


Route::group(['middleware' => ['auth', 'role:admin|manager']], function () {
    Route::get('', function () {
        return view('welcome');
    });




    Route::resource('clients', 'ClientController');

    Route::resource('worksheets', 'WorksheetController');
    Route::post('worksheets/{worksheet}/import', 'WorksheetController@import');
    Route::post('worksheets/{worksheet}/assign', 'WorksheetController@assign');

    Route::resource('workers', 'WorkerController');

    Route::resource('tasks', 'TaskController');

    Route::resource('projects', 'ProjectController');

    Route::group(['prefix' => 'task-requests'], function () {
        Route::get('', 'TaskRequestController@index');
        Route::post('{request}/approve', 'TaskRequestsController@approve');
    });



    Route::group(['prefix' => 'inbox'], function () {
        Route::get('', 'InboxController@index');
        Route::post('', 'InboxController@store');
        Route::get('delete/{id}', 'InboxController@destroy');
        Route::get('assign/{id}', 'InboxController@assign');
        Route::post('assign/{id}', 'InboxController@assignStore');
        Route::get('done/{id}', 'InboxController@done');
    });

    Route::group(['prefix' => 'control'], function () {
        Route::get('', 'ControlController@index');
        Route::get('done/{id}', 'ControlController@done');
        Route::get('check/{id}', 'ControlController@check');
        Route::get('edit/{id}', 'ControlController@edit');
    });

    // Route::group(['prefix' => 'projects'], function () {
    //     Route::get('', 'ProjectController@index');
    //     Route::post('', 'ProjectController@store');
    //     Route::post('update/{id}', 'ProjectController@update');
    //     Route::get('delete/{id}', 'ProjectController@destroy');
    //     Route::get('edit/{id}', 'ProjectController@edit');
    // });

    // Route::group(['prefix' => 'tasks'], function () {
    //     Route::get('', 'TaskController@index');
    //     Route::get('{task}', 'TaskController@show');
    //     Route::post('', 'TaskController@store');
    //     Route::post('update/{id}', 'TaskController@update');
    //     Route::get('delete/{id}', 'TaskController@destroy');
    //     Route::get('edit/{id}', 'TaskController@edit');
    // });



    // Route::group(['prefix' => 'workers'], function () {
    //     Route::get('', 'WorkerController@index');
    //     Route::post('', 'WorkerController@store');
    //     Route::post('update/{id}', 'WorkerController@update');
    //     Route::get('delete/{id}', 'WorkerController@destroy');
    //     Route::get('edit/{id}', 'WorkerController@edit');
    // });

    // Route::group(['prefix' => 'worksheets'], function () {
    //     Route::get('', 'WorksheetController@index');
    //     Route::post('', 'WorksheetController@store');
    //     Route::post('import', 'WorksheetController@import');
    //     Route::post('assign', 'WorksheetController@assign');
    // });

    Route::group(['prefix' => 'api'], function () {
        Route::group(['prefix' => 'worksheets'], function () {
            Route::get('unassigned', 'WorksheetController@apiUnassigned');
        });
        Route::group(['prefix' => 'projects'], function () {
            Route::get('', 'ProjectController@apiIndex');
        });
    });
});
