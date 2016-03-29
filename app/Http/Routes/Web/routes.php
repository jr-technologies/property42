<?php

Route::get('/login',
    [
        'uses'=>'Auth\AuthController@showLoginPage', 'as'=>'loginPage'
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


Route::post('/login',
    [
        'middleware'=>
            [
                'webValidate:loginRequest'
            ],
        'uses'=>'Auth\AuthController@login', 'as' =>'login'
    ]
);

Route::get('/register',
    [
        'uses'=>'Auth\AuthController@showRegisterPage'
    ]
);
Route::post('/register',
    [
        'middleware'=>
            [
                'webValidate:registrationRequest'
            ],
        'uses'=>'Auth\AuthController@register',
        'as' => 'register'
    ]
);