<?php
use App\Events\Events\Feature\FeatureJsonCreated;
use App\Libs\Json\Creators\Creators\Property\PropertyJsonCreator;
use App\Repositories\Repositories\Sql\FeaturesRepository;
use App\Repositories\Repositories\Sql\PropertiesRepository;
use Illuminate\Support\Facades\Route;

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

//Route::post('release', function(){
//    (new App\Libs\File\FileRelease('users\e4da3b7fbbce2345d7772b0674a318d5\agencies\7b6d28736a7d9800e51afefe78c733b3\7b6d28736a7d9800e51afefe78c733b3.jpg'))
//        ->release();
//
//
//
//    $files = [
//        'users\e4da3b7fbbce2345d7772b0674a318d5\agencies\7b6d28736a7d9800e51afefe78c733b3\7b6d28736a7d9800e51afefe78c733b3.jpg',
//        'users\1679091c5a880faf6fb5e6087eb1b2dc\agencies\1e59acc6a1d0b87111da81a47741e1b1\1e59acc6a1d0b87111da81a47741e1b1.jpeg'
//    ];
//
//    \App\Libs\File\FileRelease::multiRelease($files);
//});
//This route use for assign feature to subtype
//Route::get('f', function(){
//    for($i = 1; $i <= 19; $i++) {
//        $rands = [];
//        for($a = 1; $a <= 58; $a++){
//            $rands[] = rand(1,58);
//        }
//        $uniqueValues = array_unique($rands);
//        foreach ($uniqueValues as $value) {
//            echo "['property_sub_type_id' => " . $i . ", 'property_feature_id'=>" . $value . "],";
//            echo "<br>";
//        }
//    }
//});

 Route::get('properties/json',function(){
    $properties = (new PropertiesRepository())->all();
     $finalResult = [];

     foreach($properties as $property){

         $propertyJson = (new PropertyJsonCreator($property))->create();
         $finalResult[] = [ 'property_id' => $property->id, 'json'=> $propertyJson];
     }
     dd($finalResult);
});


Route::get('feature/json',function(){
    $feature = new FeaturesRepository();
    $subTypeId = 1;
    Event::fire(new FeatureJsonCreated($subTypeId));
});

Route::get('fe',function(){
    $feature = new FeaturesRepository();
    $features = $feature->allAssigned();
    //dd($features);
    $collection = collect($features);
    //dd($collection);
    $collection = $collection->each(function ($item, $key) {
        $item->sectionName = $item->section->name;
    });
    $groupedBySection = $collection->groupBy('sectionName');
    $finalArray = [];
    $groupedBySection->each(function($featuresCollection,$key) use (&$finalArray){
        $features = $featuresCollection->all();
        $section = clone($features[0]->section);
        $section->features = $features;
        //dd($section);
        $finalArray[$key] = $section;
    });

    dd(json_encode($finalArray));
});
Route::post('test/ng', function(){
    $response = new App\Http\Responses\Responses\ApiResponse();
    $request = request();
    //dd($request->get('features'));
    dd($request->all()['files']);
    $mainImage = (isset($files[0]))?$files[0]: null;
    dd($request->files->all()['file']);
    return $response->respond(['data' => [
        'file' => $request->files
    ]]);
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

Route::post('user/update',
    [
        'middleware'=>
            [
                'apiValidate:UpdateUserRequest'
            ],
        'uses'=>'UsersController@updateUser'
    ]
);

Route::post('user/agency/staff',
    [
        'middleware'=>
            [
                //'apiAuthenticate:getUsersRequest'
               'apiValidate:addAgencyStaffRequest'
            ],
        'uses'=>'AgencyController@addAgencyStaff'
    ]
);

Route::post('user/agency/staff/update',
    [
        'middleware'=>
            [
                //'apiAuthenticate:getUsersRequest'
                'apiValidate:updateAgencyStaffRequest'
            ],
        'uses'=>'AgencyController@updateAgencyStaff'
    ]
);

Route::post('user/agency/staff/delete',
    [
        'middleware'=>
            [
                //'apiAuthenticate:getUsersRequest'
                'apiValidate:deleteAgencyStaffRequest'
            ],
        'uses'=>'AgencyController@deleteAgencyStaff'
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
                //'apiAuthenticate:addCityRequest',
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

Route::post('society/blocks',
    [
        'middleware'=>
            [
                'apiValidate:getBlocksBySocietyRequest'
            ],

        'uses'=>'BlocksController@getBlocksBySociety'
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
                'apiValidate:getAllBlocksRequest'
            ],
        'uses'=>'BlocksController@all'
    ]
);

/**
 * Properties routes
 */

Route::post('/property',
    [
        'middleware'=>
            [
                //'apiAuthenticate:addCityRequest',
                'apiValidate:addPropertyRequest'
            ],
        'uses'=>'PropertiesController@store'
    ]
);

Route::get('user/properties',
    [
        'middleware'=>
            [
                'apiValidate:getUserPropertiesRequest'
            ],
        'uses'=>'PropertiesController@getUserProperties'
    ]
);

Route::post('property/update',
    [
        'middleware'=>
            [
                'apiValidate:updatePropertyRequest'
            ],
        'uses'=>'PropertiesController@update'
    ]
);

Route::post('property/delete',
    [
        'middleware'=>
            [
                'apiValidate:deletePropertyRequest'
            ],
        'uses'=>'PropertiesController@delete'
    ]
);

Route::get('count/properties',
    [
        'middleware'=>
            [
                'apiValidate:countPropertiesRequest'
            ],
        'uses'=>'PropertiesController@countProperties'
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
                'apiValidate:getAllPropertyPurposesRequest'
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
                'apiValidate:getAllPropertyTypesRequest'
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
                'apiValidate:getAllPropertySubTypesRequest'
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
 * feature Crud
 **/
Route::post('feature',

    [
        'middleware'=>
            [
                'apiValidate:addFeatureRequest'
            ],

        'uses'=>'FeaturesController@store'

    ]
);
Route::post('feature/update',
    [
        'middleware'=>
            [
                'apiValidate:updateFeatureRequest'
            ],
        'uses'=>'FeaturesController@update'
    ]
);
Route::post('feature/delete',
    [
        'middleware'=>
            [
                'apiValidate:deleteFeatureRequest'
            ],
        'uses'=>'FeaturesController@delete'
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

Route::post('assigned/subtype/feature',
    [
        'middleware'=>
            [
                'apiValidate:assignFeatureRequest'
            ],
        'uses'=>'PropertySubTypeController@assignFeature'
    ]
);

Route::get('features/assigned',
    [
        'middleware'=>
            [
                //'apiValidate:getAllFeatureSectionRequest'
            ],
        'uses'=>'FeaturesController@allAssigned'
    ]
);

/*
 Agency Crud
 */
Route::post('agency',

    [
        'middleware'=>
            [
                'apiValidate:AddAgencyRequest'
            ],
        'uses'=>'AgencyController@store'
    ]
);
Route::post('agency/staff',
    [
        'middleware'=>
            [
                'apiValidate:getAgencyStaffRequest'
            ],
        'uses'=>'AgencyController@getStaff'
    ]
);


Route::post('agency/update',

    [
        'middleware'=>
            [
                'apiValidate:UpdateAgencyRequest'
            ],
        'uses'=>'AgencyController@update'
    ]
);




/**
 * Property Like Crud
 **/
Route::post('property/like/increment',

    [
        'middleware'=>
            [
                //'apiAuthenticate:addCityRequest',
                'apiValidate:AddPropertyLikeRequest'
            ],
        'uses'=>'PropertyLikeController@store'
    ]
);
Route::post('property/like/decrement',
    [
        'middleware'=>
            [
                'apiValidate:deletePropertyLikeRequest'
            ],
        'uses'=>'PropertyLikeController@delete'
    ]
);


/*
 User Role Crud
*/

Route::post('user/role/add',
    [
        'middleware'=>
            [
                'apiValidate:addUserRoleRequest'
            ],

        'uses'=>'UserRolesController@store'
    ]
);
Route::post('user/role/update',
    [
        'middleware'=>
            [

                'apiValidate:updateUserRoleRequest',
            ],

        'uses'=>'UserRolesController@update'
    ]
);

Route::post('user/role/delete',
    [
        'middleware'=>
            [
                'apiValidate:deleteUserRoleRequest'
            ],
        'uses'=>'UserRolesController@delete'
    ]
);

Route::post('user/roles',
    [
        'middleware'=>
            [
                'apiValidate:getAllUserRolesRequest'
            ],
        'uses'=>'UserRolesController@all'
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
