/**
 * Created by noman_2 on 12/8/2015.
 */
//var domain = "http://localhost/jr/property42/backend/property42/public/";
//var domain = "http://localhost/production/jr-technologies/property42/public/";
var domain = "http://localhost/property42/public/";

var api = "api/v1/";
var apiPath = domain+api;
var views = domain+"ng-apps/dashboard/v1/views";
var app = angular.module('dashboard');
app.config(function($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise("/home/properties/all");

    // Now set up the states
    $stateProvider
        .state('home', {
            url: "/home",
            templateUrl: views+"/home.html",
            controller: "HomeController",
            auth: true,
            resolve: {
                resources : function ($ResourceLoader) {
                    if($ResourceLoader.needsLoading())
                    {
                        return $ResourceLoader.loadAll();
                    }
                }
            }
        })
        .state('home.properties', {
            url: "/properties",
            templateUrl: views+"/properties/home.html",
            controller: "HomeController",
            auth: true,
            resolve: {
                resources : function ($ResourceLoader) {
                    if($ResourceLoader.needsLoading())
                    {
                        return $ResourceLoader.loadAll();
                    }
                }
            }
        })
        .state('home.properties.add', {
            url: "/add",
            templateUrl: views+"/properties/addPropertyForm.html",
            auth: true,
            resolve: {
                resources : function ($ResourceLoader) {
                    if($ResourceLoader.needsLoading())
                    {
                        return $ResourceLoader.loadAll();
                    }
                }
            }
        })
        .state('home.properties.edit', {
            url: "/edit/{propertyId}",
            templateUrl: views+"/properties/editPropertyForm.html",
            auth: true,
            resolve: {
                resources : function ($stateParams, $ResourceLoader, $rootScope) {
                    if($ResourceLoader.needsLoading()){
                        return $ResourceLoader.loadAll();
                    }else{
                        return $rootScope.resources;
                    }
                }
            }
        })
        .state('home.properties.all', {
            url: "/all",
            templateUrl: views+"/properties/list.html",
            auth: true,
            resolve: {
                resources : function ($ResourceLoader) {
                    if($ResourceLoader.needsLoading())
                    {
                        return $ResourceLoader.loadAll();
                    }
                }
            }
        })
        .state('home.properties.for-sale', {
            url: "/for-sale",
            templateUrl: views+"/properties/list.html",
            auth: true,
            resolve: {
                resources : function ($ResourceLoader) {
                    if($ResourceLoader.needsLoading())
                    {
                        return $ResourceLoader.loadAll();
                    }
                }
            }
        })
        .state('home.properties.for-rent', {
            url: "/for-rent",
            templateUrl: views+"/properties/list.html",
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


