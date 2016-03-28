<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/user/add',
    [
        'middleware'=>
            [
                'webAuthenticate:addUserRequest',
                'webAuthorize:addUserRequest',
                'webValidate:addUserRequest'
            ],
        'uses'=>'UsersController@store'
    ]
);
Route::get('/dashboard',
    [
        'middleware'=>
            [
                'webAuthenticate:updatePropertyRequest',
                'webAuthorize:updatePropertyRequest',
                'webValidate:updatePropertyRequest'
            ],
        'uses'=>'AppsController@frontView'
    ]
);



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
