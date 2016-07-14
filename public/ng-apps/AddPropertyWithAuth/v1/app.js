/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('addPropertyWithAuth',[
    'ngRoute', 'ui.router','ui.select',
    'ngFileUpload', 'ngSanitize',
    'checklist-model'
]);

app.run(function($rootScope, $location, $AuthService, $state, $ErrorResponseHandler) {
    $rootScope.domain = domain;
    $rootScope.APP_STATUS = 'ok';
    $rootScope.html_title = "Property42 Dashboard";
    $rootScope.resources = null;
    $rootScope.resourceLoading = false;
    $rootScope.please_wait_class = '';
    $rootScope.loading_resources_class = '';
    $rootScope.loading_content_class = '';
    $rootScope.activeLink = '';

    $rootScope.$on( "$stateChangeStart", function(event, next, current) {
        $rootScope.activeLink = next.name;
        $rootScope.loading_content_class = 'loading-content';
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

    $rootScope.$on('error-response-received', function (event, args) {
        $ErrorResponseHandler.handle(args.status);
    });
});
