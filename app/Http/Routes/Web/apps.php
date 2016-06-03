<?php

/* Dashboard app will be launched from here.. */
\Illuminate\Support\Facades\Route::get('/dashboard',[
    'middleware' => [
        'webAuthenticate:getDashboardAppRequest'
    ],
    'uses'=>'AppsController@dashboard',
    'as'=>'dashboard'
]);
