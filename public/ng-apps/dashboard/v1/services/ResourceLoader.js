/**
 * Created by zeenomlabs on 12/11/2015.
 */
var app = angular.module('dashboard');
app.factory("$ResourceLoader", function ($rootScope, $http, $AuthService) {
    return {
        loadAll: function () {
            var headerInfo = {
                Authorization:$AuthService.getAppToken()
            };
            $rootScope.APP_STATUS = 'fetching resources...';
            var promise = $http({
                method: 'GET',
                url: apiPath+'apps/dashboard/resources',
                headers: headerInfo
            }).then(function successCallback(response) {
                $rootScope.RECOURCES = response.data.data.resources;
            }, function errorCallback(response) {
                return false;
            });

            return promise;
        }
    }
});