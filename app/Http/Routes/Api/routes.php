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
/*This route use for testing through postman*/

//Route::Post('get-city-test', function(){
//    $cityFactory = new \App\DB\Providers\SQL\Factories\Factories\City\CityFactory();
//    $city = new \App\DB\Providers\SQL\Models\City();
//
//    $id = request()->get('society_id');
//    //$city->countryId = request()->get('country_id');
//    //$city->name = request()->get('city_name');
//
//    return response()->json($cityFactory->getBySociety($id));
//});



Route::get('/users',
    [
        'middleware'=>
            [
                //'apiAuthenticate:getUsersRequest'
            ],
        'uses'=>'UsersController@index'
    ]
);

Route::post('/login',
    [
        'middleware'=>
            [
                'apiValidate:loginRequest'
            ],
        'uses'=>'Auth\AuthController@login'
    ]
);

Route::post('/register',
    [
        'middleware'=>
            [
                'apiValidate:registrationRequest'
            ],
        'uses'=>'Auth\AuthController@register'
    ]
);

/**
 * Countries Crud
 **/
Route::post('/country',
    [
        'middleware'=>
            [
                //'apiAuthenticate:addCountryRequest',
                'apiValidate:addCountryRequest'
            ],
        'uses'=>'CountriesController@store'
    ]
);
Route::post('country/update',
    [
        'middleware'=>
            [
                'apiValidate:updateCountryRequest'
            ],
        'uses'=>'CountriesController@update'
    ]
);
Route::post('country/delete',
    [
        'middleware'=>
            [
                //'apiValidate:deleteCountryRequest'
            ],
        'uses'=>'CountriesController@delete'
    ]
);
Route::post('countries',
    [
        'middleware'=>
            [
                'apiValidate:getAllCountriesRequest'
            ],
        'uses'=>'CountriesController@all'
    ]
);

/**
 * Cities Crud
 **/
Route::post('/city',
    [
        'middleware'=>
            [
                'apiAuthenticate:addCityRequest',
                'apiValidate:addCityRequest'
            ],
        'uses'=>'CitiesController@store'
    ]
);
Route::post('city/update',
    [
        'middleware'=>
            [
                'apiValidate:updateCityRequest'
            ],
        'uses'=>'CitiesController@update'
    ]
);
Route::post('city/delete',
    [
        'middleware'=>
            [
                'apiValidate:deleteCityRequest'
            ],
        'uses'=>'CitiesController@delete'
    ]
);
Route::get('cities',
    [
        'middleware'=>
            [
                'apiValidate:getAllCitiesRequest'
            ],
        'uses'=>'CitiesController@all'
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

Route::group(/**
 *
 */
    ['middleware' => ['web']], function () {
    //
});
