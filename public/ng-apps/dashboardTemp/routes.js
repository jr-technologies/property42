/**
 * Created by noman_2 on 12/8/2015.
 */
var views = "ng-app/views";
var domain = "http://localhost/production/virik_3/public/";
var api = "api/v1/";
var apiPath = domain+api;

var app = angular.module('inventory_system');
app.config(function($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise("/home/customers/");
    //
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
        .state('home.customers', {
            url: "/customers",
            templateUrl: views+"/customers/index.html",
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


