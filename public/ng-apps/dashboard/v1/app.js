/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard',['ngRoute', 'ui.router','ui.select', 'firebase', 'ngFileUpload', 'ngSanitize']);


app.run(function($rootScope, $location, $AuthService, $state) {
    $rootScope.AUTH_TOKEN = '$2y$10$tSM.PiN9BnMfyonqjHlwTONa1DPHbyQSAMOtmt4chJYXenGeYySHC';
    $rootScope.AUTH_USER = null;
    $rootScope.APP_STATUS = 'ok';
    $rootScope.html_title = "Property42 Dashboard";
    $rootScope.RECOURCES = [];
    $rootScope.USERS = [];

    $rootScope.please_wait_class = '';
    $rootScope.defaultSearchPropertiesParams = {
        owner_id: null,
        purpose_id: 1,
        status_id: 1
    };
    $rootScope.searchPropertiesParams = $rootScope.defaultSearchPropertiesParams;
    $rootScope.activeLink = '';

    $rootScope.$on( "$stateChangeStart", function(event, next, current) {
        $rootScope.activeLink = next.name;
        /*
        * Description:
        * if the next route is for authenticated users and
        * user is not authenticated yet then we should redirect
        * him to login page.
        * */
        /*if(next.auth == true && $AuthService.getAppToken() == null){
            $location.path($state.href('login').substring(1));
        }*/

        /*
        * Description:
        * if the next route is login and user is already logged in
        * then whe should take him back to his profile.
        * */
        if(next.name == "login" && $AuthService.getAppToken() != null){
            $location.path($state.href('home').substring(1));
        }
    });
});
