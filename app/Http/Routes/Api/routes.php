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

Route::post('release', function(){
//    (new App\Libs\File\FileRelease('users\e4da3b7fbbce2345d7772b0674a318d5\agencies\7b6d28736a7d9800e51afefe78c733b3\7b6d28736a7d9800e51afefe78c733b3.jpg'))
//        ->release();



    $files = [
        'users\e4da3b7fbbce2345d7772b0674a318d5\agencies\7b6d28736a7d9800e51afefe78c733b3\7b6d28736a7d9800e51afefe78c733b3.jpg',
        'users\1679091c5a880faf6fb5e6087eb1b2dc\agencies\1e59acc6a1d0b87111da81a47741e1b1\1e59acc6a1d0b87111da81a47741e1b1.jpeg'
    ];

    \App\Libs\File\FileRelease::multiRelease($files);
});



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
Route::post('cities-by-society',
    [
        'middleware'=>
            [
                'apiValidate:getCitiesBySocietyRequest'
            ],
        'uses'=>'CitiesController@getBySociety'
    ]
);

Route::post('cities-by-country',
    [
        'middleware'=>
            [
                'apiValidate:getCitiesByCountryRequest'
            ],
        'uses'=>'CitiesController@getByCountry'
    ]
);

/**
 * Society Crud
 **/
Route::post('/society',
    [
        'middleware'=>
            [
                //'apiAuthenticate:addCityRequest',
                'apiValidate:addSocietyRequest'
            ],
        'uses'=>'SocietiesController@store'
    ]
);
Route::post('society/update',
    [
        'middleware'=>
            [
                'apiValidate:updateSocietyRequest'
            ],
        'uses'=>'SocietiesController@update'
    ]
);
Route::post('society/delete',
    [
        'middleware'=>
            [
                'apiValidate:deleteSocietyRequest'
            ],
        'uses'=>'SocietiesController@delete'
    ]
);
Route::get('societies',
    [
        'middleware'=>
            [
                'apiValidate:getAllSocietiesRequest'
            ],
        'uses'=>'SocietiesController@all'
    ]
);

/**
 * Block Crud
 **/
Route::post('/block',
    [
        'middleware'=>
            [
                //'apiAuthenticate:addCityRequest',
               // 'apiValidate:addBlockRequest'
            ],
        'uses'=>'BlocksController@store'
    ]
);
Route::post('block/update',
    [
        'middleware'=>
            [
                'apiValidate:updateBlockRequest'
            ],
        'uses'=>'BlocksController@update'
    ]
);
Route::post('block/delete',
    [
        'middleware'=>
            [
                'apiValidate:deleteBlockRequest'
            ],
        'uses'=>'BlocksController@delete'
    ]
);
Route::get('blocks',
    [
        'middleware'=>
            [
                'apiValidate:getAllBlockRequest'
            ],
        'uses'=>'BlocksController@all'
    ]
);

/**
 * Property Purpose Crud
 **/
Route::post('/property/purpose',
    [
        'middleware'=>
            [
                //'apiAuthenticate:addCityRequest',
                'apiValidate:addPropertyPurposeRequest'
            ],
        'uses'=>'PropertyPurposeController@store'
    ]
);
Route::post('property/purpose/update',
    [
        'middleware'=>
            [
                'apiValidate:updatePropertyPurposeRequest'
            ],
        'uses'=>'PropertyPurposeController@update'
    ]
);
Route::post('property/purpose/delete',
    [
        'middleware'=>
            [
                'apiValidate:deletePropertyPurposeRequest'
            ],
        'uses'=>'PropertyPurposeController@delete'
    ]
);
Route::get('property/purposes',
    [
        'middleware'=>
            [
                'apiValidate:getAllPropertyPurposeRequest'
            ],
        'uses'=>'PropertyPurposeController@all'
    ]
);


/**
 * Property Type Crud
 **/
Route::post('/property/type',

    [
        'middleware'=>
            [
                //'apiAuthenticate:addCityRequest',
                'apiValidate:addPropertyTypeRequest'
            ],
        'uses'=>'PropertyTypeController@store'
    ]
);
Route::post('property/type/update',
    [
        'middleware'=>
            [
                'apiValidate:updatePropertyTypeRequest'
            ],
        'uses'=>'PropertyTypeController@update'
    ]
);
Route::post('property/type/delete',
    [
        'middleware'=>
            [
                'apiValidate:deletePropertyTypeRequest'
            ],
        'uses'=>'PropertyTypeController@delete'
    ]
);
Route::get('property/types',
    [
        'middleware'=>
            [
                'apiValidate:getAllPropertyTypeRequest'
            ],
        'uses'=>'PropertyTypeController@all'
    ]
);

Route::post('type-by-subtype',
    [
        'middleware'=>
            [
                'apiValidate:getTypeBySubTypeRequest'
            ],
        'uses'=>'PropertyTypeController@getBySubType'
    ]
);
/**
 * Property Sub Type Crud
 **/
Route::post('/property/subtype',

    [
        'middleware'=>
            [
                //'apiAuthenticate:addCityRequest',
                'apiValidate:addPropertySubTypeRequest'
            ],
        'uses'=>'PropertySubTypeController@store'
    ]
);
Route::post('property/subtype/update',
    [
        'middleware'=>
            [
                'apiValidate:updatePropertySubTypeRequest'
            ],
        'uses'=>'PropertySubTypeController@update'
    ]
);
Route::post('property/subtype/delete',
    [
        'middleware'=>
            [
                'apiValidate:deletePropertySubTypeRequest'
            ],
        'uses'=>'PropertySubTypeController@delete'
    ]
);
Route::get('property/subtypes',
    [
        'middleware'=>
            [
                'apiValidate:getAllPropertySubTypeRequest'
            ],
        'uses'=>'PropertySubTypeController@all'
    ]
);

Route::post('subtype-by-type',
    [
        'middleware'=>
            [
                'apiValidate:getSubTypesByTypeRequest'
            ],
        'uses'=>'PropertySubTypeController@getByType'
    ]
);
/**
 * LandUnit Crud
 **/
Route::post('/landUnit',

    [
        'middleware'=>
            [
                //'apiAuthenticate:addCityRequest',
                'apiValidate:addLandUnitRequest'
            ],
        'uses'=>'LandUnitController@store'
    ]
);
Route::post('landUnit/update',
    [
        'middleware'=>
            [
                'apiValidate:updateLandUnitRequest'
            ],
        'uses'=>'LandUnitController@update'
    ]
);
Route::post('landUnit/delete',
    [
        'middleware'=>
            [
                'apiValidate:deleteLandUnitRequest'
            ],
        'uses'=>'LandUnitController@delete'
    ]
);
Route::get('landUnits',
    [
        'middleware'=>
            [
                'apiValidate:getAllLandUnitsRequest'
            ],
        'uses'=>'LandUnitController@all'
    ]
);


/**
 * PropertyStatus Crud
 **/
Route::post('property/status',

    [
        'middleware'=>
            [
                //'apiAuthenticate:addCityRequest',
                'apiValidate:addPropertyStatusRequest'
            ],
        'uses'=>'PropertyStatusController@store'
    ]
);
Route::post('property/status/update',
    [
        'middleware'=>
            [
                'apiValidate:updatePropertyStatusRequest'
            ],
        'uses'=>'PropertyStatusController@update'
    ]
);
Route::post('property/status/delete',
    [
        'middleware'=>
            [
                'apiValidate:deletePropertyStatusRequest'
            ],
        'uses'=>'PropertyStatusController@delete'
    ]
);
Route::get('property/statuses',
    [
        'middleware'=>
            [
                'apiValidate:getAllPropertyStatusRequest'
            ],
        'uses'=>'PropertyStatusController@all'
    ]
);



/**
 * feature Section Crud
 **/
Route::post('feature/section',

    [
        'middleware'=>
            [
                //'apiAuthenticate:addCityRequest',
                'apiValidate:addFeatureSectionRequest'
            ],

        'uses'=>'FeatureSectionsController@store'

    ]
);
Route::post('feature/section/update',
    [
        'middleware'=>
            [
                'apiValidate:updateFeatureSectionRequest'
            ],
        'uses'=>'FeatureSectionsController@update'
    ]
);
Route::post('feature/section/delete',
    [
        'middleware'=>
            [
                'apiValidate:deleteFeatureSectionRequest'
            ],
        'uses'=>'FeatureSectionsController@delete'
    ]
);
Route::get('feature/sections',
    [
        'middleware'=>
            [
                'apiValidate:getAllFeatureSectionRequest'
            ],
        'uses'=>'FeatureSectionsController@all'
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
