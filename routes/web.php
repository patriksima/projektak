<?php

/*
|--------------------------------------------------------------------------
| Auth routes
|--------------------------------------------------------------------------
|
| These few lines specify all the application's authentication routes.
|
*/

// auth()->logout();
// auth()->loginUsingId(1);

Route::get('login', 'Auth\LoginController@show');
Route::get('auth/{provider}', 'Auth\SocialAuthController@redirect');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@callback');

/*
|--------------------------------------------------------------------------
| Miscellaneous routes
|--------------------------------------------------------------------------
|
| Uncategorized routes go here.
|
*/

Route::get('', function () {
    return view('welcome');
})->middleware('auth');

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::resource('users', 'UserController');
});

Route::group(['middleware' => ['auth', 'role:admin|manager']], function () {
    Route::get('{resource}/{id}/discussion', 'DiscussionController@general');
    Route::get('{resource}/{id}/discussion/internal', 'DiscussionController@internal');
    Route::resource('clients', 'ClientController');

    Route::resource('worksheets', 'WorksheetController');
    Route::post('worksheets/import', 'WorksheetController@import');
    Route::post('worksheets/assign', 'WorksheetController@assign');

    Route::resource('inbox', 'InboxController');
    Route::patch('inbox/{message}/complete', 'InboxController@complete');
    Route::post('inbox/{message}/assign', 'InboxController@assign');

    Route::resource('workers', 'WorkerController');

    Route::resource('tasks', 'TaskController');

    Route::resource('projects', 'ProjectController');

    Route::group(['prefix' => 'task-requests'], function () {
        Route::get('', 'TaskRequestController@index');
        Route::patch('{request}/approve', 'TaskRequestController@approve');
        Route::patch('{request}/deny', 'TaskRequestController@deny');
    });

    Route::group(['prefix' => 'control'], function () {
        Route::get('', 'ControlController@index');
        Route::patch('{task}/complete', 'ControlController@complete');
        Route::patch('{task}/check', 'ControlController@check');
    });

    Route::group(['prefix' => 'api'], function () {
        Route::group(['prefix' => 'worksheets'], function () {
            Route::get('unassigned', 'WorksheetController@apiUnassigned');
        });
        Route::group(['prefix' => 'projects'], function () {
            Route::get('', 'ProjectController@apiIndex');
        });
    });
});

// User routes

Route::group(['middleware' => ['auth', 'role:worker'], 'prefix' => 'user'], function () {
    Route::group(['prefix' => 'tasks'], function () {
        Route::get('/', 'User\TaskController@index');
        Route::post('/', 'User\TaskController@store');
        Route::post('update/{id}', 'User\TaskController@update');
        Route::get('delete/{id}', 'User\TaskController@destroy');
        Route::get('edit/{id}', 'User\TaskController@edit');
        Route::post('request', 'User\TaskController@request');
    });

    Route::get('/', 'User\DashboardController@index');

    Route::group(['prefix' => 'api'], function () {
        Route::group(['prefix' => 'task'], function () {
            Route::post('/start', 'User\TaskController@apiStart');
            Route::post('/stop', 'User\TaskController@apiStop');
            Route::post('/done', 'User\TaskController@apiDone');
            Route::post('/request', 'User\TaskController@apiRequest');
        });
        Route::group(['prefix' => 'tasks'], function () {
            Route::get('/', 'User\TaskController@apiIndex');
        });
    });
});
