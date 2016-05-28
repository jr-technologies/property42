/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard',['ngRoute', 'ui.router','ui.select', 'firebase', 'ngFileUpload', 'ngSanitize']);


app.filter('filterByCountParam', [function () {
    return function (counts, purpose, status) {
        if(purpose == null)
            purpose = undefined;
        if(status == null)
            status = undefined;
        var totalLikes = 0;
        if(purpose != undefined || status != undefined)
        {
            if(purpose != undefined && status != undefined){
                totalLikes = parseInt(counts[purpose][status]);
            }else if(purpose != undefined && status === undefined){
                angular.forEach(counts[purpose], function (value, key) {
                    totalLikes += parseInt(value);
                });
            } else if(purpose === undefined && status != undefined){
                angular.forEach(counts, function (tempPurpose, pKey) {
                    totalLikes += parseInt(counts[pKey][status])
                });
            }
        }
        else
        {
            angular.forEach(counts, function (tempPurpose, pKey) {
                angular.forEach(tempPurpose, function (tempStatus, sKey) {
                    totalLikes += parseInt(tempStatus);
                });
            });
        }
        return totalLikes;
    };
}]);

app.run(function($rootScope, $location, $AuthService, $state, $ErrorResponseHandler) {
    $rootScope.AUTH_TOKEN = '$2y$10$tSM.PiN9BnMfyonqjHlwTONa1DPHbyQSAMOtmt4chJYXenGeYySHC';
    $rootScope.AUTH_USER = null;
    $rootScope.APP_STATUS = 'ok';
    $rootScope.html_title = "Property42 Dashboard";
    $rootScope.propertiesCounts = {};
    $rootScope.RECOURCES = [];
    $rootScope.USERS = [];
    $rootScope.purposes = [
        {
            id: 1,
            name: 'for-sale',
            displayName: 'for sale'
        },
        {
            id: 2,
            name: 'for-rent',
            displayName: 'for rent'
        }
    ];
    $rootScope.please_wait_class = '';
    $rootScope.defaultSearchPropertiesParams = {
        owner_id: null,
        purpose_id: 1,
        status_id: 1
    };
    $rootScope.searchPropertiesParams = $rootScope.defaultSearchPropertiesParams;
    $rootScope.activeLink = '';

    $rootScope.propertiesCounts = {};
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

    $rootScope.$on('error-response-received', function (event, args) {
        $ErrorResponseHandler.handle(args.status);
    });
});
