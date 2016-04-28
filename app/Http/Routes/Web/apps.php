<?php

/* Dashboard app will be launched from here.. */
\Illuminate\Support\Facades\Route::get('/dashboard',['uses'=>'AppsController@dashboard', 'as'=>'dashboard']);
