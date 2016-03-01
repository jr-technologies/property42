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
use App\Property;
use Illuminate\Support\Facades\DB;
Route::get('/', function () {
    //return view('welcome');
/*    $country = (new \App\Country())->find(1);
    $country_obj = json_decode($country->country);
    $country_obj->email = "waqas@gmail.com";
    $country_json = json_encode($country_obj);
    //dd($country_json);
    DB::table('countries')
        ->where('id', 1)
        ->update(['country' => $country_json]);*/
});

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

Route::group(['middleware' => ['web']], function () {
    //
});
