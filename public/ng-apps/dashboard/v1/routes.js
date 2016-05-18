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
        .state('login',{
            url: "/login",
            templateUrl:views+"/login.html",
            controller: "LoginController",
            auth: false
        })
        .state('home', {
            url: "/home",
            templateUrl: views+"/home.html",
            controller: "HomeController",
            auth: true
        })
        .state('home.properties', {
            url: "/properties",
            templateUrl: views+"/properties/home.html",
            controller: "HomeController",
            auth: true
        })
        .state('home.properties.add', {
            url: "/add",
            templateUrl: views+"/properties/addPropertyForm.html",
            auth: true
        })
        .state('home.properties.all', {
            url: "/all",
            templateUrl: views+"/properties/list.html",
            auth: true
        })
        .state('home.customers.all', {
            url: "/",
            templateUrl: views+"/customers/show.html",
            controller: "ShowCustomersController",
            auth: true
        })
        .state('home.customers.add',{
            url:"/add-new-customer",
            templateUrl: views+"/customers/add.html",
            controller: "AddCustomersController",
            auth:true
        })
});


