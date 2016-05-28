<?php
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