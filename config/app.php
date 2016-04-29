<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services your application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => 'http://localhost',

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Logging Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log settings for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Settings: "single", "daily", "syslog", "errorlog"
    |
    */

    'log' => env('APP_LOG', 'single'),

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,

        /*
         * Repositories Service Providers...
         */
        App\Providers\Repositories\UsersRepositoryProvider::class,
        App\Providers\Repositories\AgenciesRepositoryProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [

        'App'       => Illuminate\Support\Facades\App::class,
        'Artisan'   => Illuminate\Support\Facades\Artisan::class,
        'Auth'      => Illuminate\Support\Facades\Auth::class,
        'Blade'     => Illuminate\Support\Facades\Blade::class,
        'Cache'     => Illuminate\Support\Facades\Cache::class,
        'Config'    => Illuminate\Support\Facades\Config::class,
        'Cookie'    => Illuminate\Support\Facades\Cookie::class,
        'Crypt'     => Illuminate\Support\Facades\Crypt::class,
        'DB'        => Illuminate\Support\Facades\DB::class,
        'Eloquent'  => Illuminate\Database\Eloquent\Model::class,
        'Event'     => Illuminate\Support\Facades\Event::class,
        'File'      => Illuminate\Support\Facades\File::class,
        'Gate'      => Illuminate\Support\Facades\Gate::class,
        'Hash'      => Illuminate\Support\Facades\Hash::class,
        'Lang'      => Illuminate\Support\Facades\Lang::class,
        'Log'       => Illuminate\Support\Facades\Log::class,
        'Mail'      => Illuminate\Support\Facades\Mail::class,
        'Password'  => Illuminate\Support\Facades\Password::class,
        'Queue'     => Illuminate\Support\Facades\Queue::class,
        'Redirect'  => Illuminate\Support\Facades\Redirect::class,
        'Redis'     => Illuminate\Support\Facades\Redis::class,
        'Request'   => Illuminate\Support\Facades\Request::class,
        'Response'  => Illuminate\Support\Facades\Response::class,
        'Route'     => Illuminate\Support\Facades\Route::class,
        'Schema'    => Illuminate\Support\Facades\Schema::class,
        'Session'   => Illuminate\Support\Facades\Session::class,
        'Storage'   => Illuminate\Support\Facades\Storage::class,
        'URL'       => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View'      => Illuminate\Support\Facades\View::class,

        /* ----------------------------------------------------------
         * Requests Aliases
         * -----------------------------------------------------------
         * */
        'AuthenticationRequest' => \App\Http\Requests\Requests\Auth\AuthenticationRequest::class,
        'RegistrationRequest' => \App\Http\Requests\Requests\Auth\RegistrationRequest::class,
        'LoginRequest' => \App\Http\Requests\Requests\Auth\LoginRequest::class,
        'AddUserRequest' => \App\Http\Requests\Requests\User\AddUserRequest::class,
        'GetUsersRequest' => \App\Http\Requests\Requests\User\GetUsersRequest::class,

        /* Loading Helpers */
        'AppHelper' => \App\Libs\Helpers\AppHelper::class,
        'PathHelper' => \App\Libs\Helpers\PathHelper::class,

        /*  Country Requests */
        'AddCountryRequest' => \App\Http\Requests\Requests\Country\AddCountryRequest::class,
        'UpdateCountryRequest' => \App\Http\Requests\Requests\Country\UpdateCountryRequest::class,
        'DeleteCountryRequest' => \App\Http\Requests\Requests\Country\DeleteCountryRequest::class,
        'GetAllCountriesRequest' => \App\Http\Requests\Requests\Country\GetAllCountriesRequest::class,

        /* City Requests */
        'AddCityRequest' => \App\Http\Requests\Requests\City\AddCityRequest::class,
        'UpdateCityRequest' => \App\Http\Requests\Requests\City\UpdateCityRequest::class,
        'DeleteCityRequest' => \App\Http\Requests\Requests\City\DeleteCityRequest::class,
        'GetAllCitiesRequest' => \App\Http\Requests\Requests\City\GetAllCitiesRequest::class,
        'GetCitiesBySocietyRequest' => \App\Http\Requests\Requests\City\GetCitiesBySocietyRequest::class,
        'GetCitiesByCountryRequest' => \App\Http\Requests\Requests\City\GetCitiesByCountryRequest::class,

        /* Society Requests */
        'AddSocietyRequest' => \App\Http\Requests\Requests\Society\AddSocietyRequest::class,
        'UpdateSocietyRequest' => \App\Http\Requests\Requests\Society\UpdateSocietyRequest::class,
        'DeleteSocietyRequest' => \App\Http\Requests\Requests\Society\DeleteSocietyRequest::class,
        'GetAllSocietiesRequest' => \App\Http\Requests\Requests\Society\GetAllSocietiesRequest::class,

        /* Block Requests */
        'AddBlockRequest' => \App\Http\Requests\Requests\Block\AddBlockRequest::class,
        'UpdateBlockRequest' => \App\Http\Requests\Requests\Block\UpdateBlockRequest::class,
        'DeleteBlockRequest' => \App\Http\Requests\Requests\Block\DeleteBlockRequest::class,
        'GetAllBlocksRequest' => \App\Http\Requests\Requests\Block\GetAllBlocksRequest::class,

        /* PropertyPurpose Requests */
        'AddPropertyPurposeRequest' => \App\Http\Requests\Requests\PropertyPurposes\AddPropertyPurposeRequest::class,
        'UpdatePropertyPurposeRequest' => \App\Http\Requests\Requests\PropertyPurposes\UpdatePropertyPurposeRequest::class,
        'DeletePropertyPurposeRequest' => \App\Http\Requests\Requests\PropertyPurposes\DeletePropertyPurposeRequest::class,
        'GetAllPropertyPurposesRequest' => \App\Http\Requests\Requests\PropertyPurposes\GetAllPropertyPurposesRequest::class,

        /* PropertyType Requests */
        'AddPropertyTypeRequest' => \App\Http\Requests\Requests\PropertyType\AddPropertyTypeRequest::class,
        'UpdatePropertyTypeRequest' => \App\Http\Requests\Requests\PropertyType\UpdatePropertyTypeRequest::class,
        'DeletePropertyTypeRequest' => \App\Http\Requests\Requests\PropertyType\DeletePropertyTypeRequest::class,
        'GetAllPropertyTypesRequest' => \App\Http\Requests\Requests\PropertyType\GetAllPropertyTypesRequest::class,
        'GetTypeBySubTypeRequest' => \App\Http\Requests\Requests\PropertyType\GetTypeBySubTypeRequest::class,

        /* PropertySubType Requests */
        'AddPropertySubTypeRequest' => \App\Http\Requests\Requests\PropertySubType\AddPropertySubTypeRequest::class,
        'UpdatePropertySubTypeRequest' => \App\Http\Requests\Requests\PropertySubType\UpdatePropertySubTypeRequest::class,
        'DeletePropertySubTypeRequest' => \App\Http\Requests\Requests\PropertySubType\DeletePropertySubTypeRequest::class,
        'GetAllPropertySubTypesRequest' => \App\Http\Requests\Requests\PropertySubType\GetAllPropertySubTypesRequest::class,
        'GetSubTypesByTypeRequest' => \App\Http\Requests\Requests\PropertySubType\GetSubTypesByTypeRequest::class,

        /* LandUnit Requests */
        'AddLandUnitRequest' => \App\Http\Requests\Requests\LandUnit\AddLandUnitRequest::class,
        'UpdateLandUnitRequest' => \App\Http\Requests\Requests\LandUnit\UpdateLandUnitRequest::class,
        'DeleteLandUnitRequest' => \App\Http\Requests\Requests\LandUnit\DeleteLandUnitRequest::class,
        'GetAllLandUnitsRequest' => \App\Http\Requests\Requests\LandUnit\GetAllLandUnitsRequest::class,

        /* Property Status Requests */
        'AddPropertyStatusRequest' => \App\Http\Requests\Requests\PropertyStatus\AddPropertyStatusRequest::class,
        'UpdatePropertyStatusRequest' => \App\Http\Requests\Requests\PropertyStatus\UpdatePropertyStatusRequest::class,
        'DeletePropertyStatusRequest' => \App\Http\Requests\Requests\PropertyStatus\DeletePropertyStatusRequest::class,
        'GetAllPropertyStatusRequest' => \App\Http\Requests\Requests\PropertyStatus\GetAllPropertyStatusRequest::class,

        /* Property Status Requests */
        'AddPropertyRequest' => \App\Http\Requests\Requests\Property\AddPropertyRequest::class,

        /* Feature Section Requests */
        'AddFeatureSectionRequest' => \App\Http\Requests\Requests\FeatureSection\AddFeatureSectionRequest::class,
        'UpdateFeatureSectionRequest' => \App\Http\Requests\Requests\FeatureSection\UpdateFeatureSectionRequest::class,
        'DeleteFeatureSectionRequest' => \App\Http\Requests\Requests\FeatureSection\DeleteFeatureSectionRequest::class,
        'GetAllFeatureSectionRequest' => \App\Http\Requests\Requests\FeatureSection\GetAllFeatureSectionRequest::class,

        /* Agency Requests */
        'AddAgencyRequest' => \App\Http\Requests\Requests\Agency\AddAgencyRequest::class,
        'UpdateAgencyRequest' => \App\Http\Requests\Requests\Agency\UpdateAgencyRequest::class,

        /* Property Like Requests */
        'AddPropertyLikeRequest' => \App\Http\Requests\Requests\PropertyLike\AddPropertyLikeRequest::class,
        'UpdatePropertyLikeRequest' => \App\Http\Requests\Requests\PropertyLike\UpdatePropertyLikeRequest::class,

    ],

];
