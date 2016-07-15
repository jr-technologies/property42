/**
 * Created by noman_2 on 12/8/2015.
 */

var domain = "http://"+window.location.hostname+"/p42/public/";
//var domain = "http://"+window.location.hostname+"/jr/property42/backend/property42/public/";
//var domain = "http://"+window.location.hostname+"/production/jr-technologies/property42/public/";
//var domain = "http://"+window.location.hostname+"/property42/public/";

var api = "api/v1/";
var apiPath = domain+api;
var views = domain+"ng-apps/AddPropertyWithAuth/v1/views";
var app = angular.module('addPropertyWithAuth');
app.config(function($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise("/");

    // Now set up the states
    $stateProvider
        .state('addProperty', {
            url: "/",
            templateUrl: views+"/addPropertyForm.html",
            controller: "AddPropertyController",
            auth: true,
            resolve: {
                resources : function ($ResourceLoader, $rootScope) {
                    if($ResourceLoader.needsLoading())
                    {
                        return $ResourceLoader.loadAll();
                    }
                }
            }
        })
});


