<?php

Route::get('/login',
    [
        'uses'=>'Auth\AuthController@showLoginPage', 'as'=>'loginPage'
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
Route::get('/',
    [
        'middleware'=>
            [
                //'webValidate:searchRequest'
            ],
        'uses'=>'PropertiesController@index',
    ]
);
Route::get('search',
    [
        'middleware'=>
            [
                //'webValidate:searchRequest'
            ],
        'uses'=>'PropertiesController@search',
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

Route::get('/logout', function(){
    if(session()->has('authUser'))
    {
        $authUser = session()->pull('authUser');
        $authUser->access_token = null;
        (new \App\Repositories\Providers\Providers\UsersRepoProvider())->repo()->update($authUser);
    }
    return redirect('/login');
});