<?php

Route::get('admin',
    [
        'middleware'=>
            [

            ],
        'uses'=>'Admin\AuthController@getLoginPage'
    ]
);

Route::post('admin/login',
    [
        'middleware'=>
            [
                // 'webAuthenticate:adminLoginRequest',
                'webValidate:adminLoginRequest'
            ],
        'uses'=>'Admin\AuthController@login'
    ]
);

Route::get('get/property',
    [
        'middleware'=>
            [
                'webValidate:getAdminPropertyRequest'
            ],
        'uses'=>'Admin\AdminController@getById'
    ]
);

Route::get('get/agent',
    [
        'middleware'=>
            [
                'webValidate:getAdminAgentRequest'
            ],
        'uses'=>'Admin\AdminController@getAgent'
    ]
);

Route::get('add-property',
    [
        'uses'=>'PropertiesController@addProperty'
    ]
);

Route::post('admin/property/reject',
    [
        'middleware'=>
            [
                'webValidate:RejectPropertyRequest'
            ],
        'uses'=>'Admin\AdminController@rejectProperty'
    ]
);



Route::post('admin/property/approve',
    [
        'middleware'=>
            [
                'webValidate:ApprovePropertyRequest'
            ],
        'uses'=>'Admin\AdminController@approveProperty'
    ]
);

Route::get('admin/properties',
    [
        'middleware'=>
            [
                'webAuthenticate:getAdminPropertiesRequest',
            ],
        'uses'=>'Admin\AdminController@getProperties'
    ]);

Route::get('admin/agents',
    [
        'middleware'=>
            [
            ],
        'uses'=>'Admin\AdminController@getAgents'
    ]);


Route::post('admin/property/approve',
    [
        'middleware'=>
            [
                'webValidate:ApprovePropertyRequest'
            ],
        'uses'=>'Admin\AdminController@approveProperty'
    ]
);

Route::post('admin/agent/approve',
    [
        'middleware'=>
            [
                'webValidate:approveAgentRequest'
            ],
        'uses'=>'Admin\AdminController@approveAgent'
    ]
);


Route::get('admin/properties',
    [
        'middleware'=>
            [
            ],
        'uses'=>'Admin\AdminController@getProperties'
    ]);

Route::get('admin/agents',
    [
        'middleware'=>
            [
            ],
        'uses'=>'Admin\AdminController@getAgents'
    ]);

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

Route::post('get-new-password',
    [
        'middleware'=>
            [
                'webValidate:forgetPasswordRequest'
            ],
        'uses'=>'UsersController@getNewPassword',
    ]
);

Route::get('forget-password',
    [
        'middleware'=>
            [
                //'webValidate:forgetPasswordRequest'
            ],
        'uses'=>'UsersController@forgetPassword',
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

Route::get('property',
    [
        'middleware'=>
            [
                'webValidate:getPropertyRequest'
            ],
        'uses'=>'PropertiesController@getById'
    ]
);


Route::get('agents',
    [
        'middleware'=>
            [
                'webValidate:getAgentsRequest'
            ],
        'uses'=>'UsersController@trustedAgents'
    ]
);

Route::get('agent',
    [
        'middleware'=>
            [
                'webValidate:getAgentRequest'
            ],
        'uses'=>'UsersController@getTrustedAgent'
    ]
);

Route::get('agent/mail',
    [
    'middleware'=>
        [
            'webValidate:agentMailRequest'
        ],
    'uses'=>'MailController@mailAgent'
]);

Route::post('mail-to-agent',
    [
        'middleware'=>
            [
                'webValidate:mailToAgentRequest'
            ],
        'uses'=>'MailController@mailToAgent'
    ]);




Route::post('contact_us',
    [
        'middleware'=>
            [
                'webValidate:contactUSMailRequest'
            ],
        'uses'=>'MailController@contactUS'
    ]);
Route::post('property-to-friend',
    [
        'middleware'=>
            [
                'webValidate:mailPropertyToFriendRequest'
            ],
        'uses'=>'MailController@mailToFriend'
    ]);

/**
trusted-agent route is not redirect on right path its temporary
**/
Route::post('trusted-agent',
    [
        'middleware'=>
            [
                'webValidate:trustedAgentRequest'
            ],
        'uses'=>'UsersController@makeTrustedAgent'
    ]);

Route::get('/logout', function(){
    if(session()->has('authUser'))
    {
        $usersRepo = (new \App\Repositories\Providers\Providers\UsersRepoProvider())->repo();
        $authUser = session()->pull('authUser');
        try{
            $authUser = $usersRepo->getById($authUser->id);
            $authUser->access_token = null;
            (new \App\Repositories\Providers\Providers\UsersRepoProvider())->repo()->update($authUser);
        }catch (\Exception $e){

        }
    }
    return redirect('/login');
});