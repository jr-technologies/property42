/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('inventory_system',['ngRoute', 'ui.router', 'firebase']);


app.run(function($rootScope, $location, $AuthService, $state) {
    $rootScope.AUTH_TOKEN = null;
    $rootScope.AUTH_USER = null;
    $rootScope.APP_STATUS = 'ok';
    $rootScope.html_title = "Inventory System";

    $rootScope.CUSTOMERS = [];
    $rootScope.USERS = [];

    $rootScope.$on( "$stateChangeStart", function(event, next, current) {

        /*
        * Description:
        * if the next route is for authenticated users and
        * user is not authenticated yet then we should redirect
        * him to login page.
        * */
        if(next.auth == true && $AuthService.getAppToken() == null){
            $location.path($state.href('login').substring(1));
        }

        /*
        * Description:
        * if the next route is login and user is already logged in
        * then whe should take him back to his profile.
        * */
        if(next.name == "login" && $AuthService.getAppToken() != null){
            $location.path($state.href('home.customers.all').substring(1));
        }
    });
});
