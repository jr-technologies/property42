/**
 * Created by zeenomlabs on 12/11/2015.
 */
var app = angular.module('dashboard');
app.factory("$ResourceLoader", function ($rootScope, $http, $AuthService) {

    return {
        isLoading: function () {
            return $rootScope.resourceLoading;
        },
        hasLoaded: function () {
            return $rootScope.resources != null;
        },
        needsLoading: function () {
            return (!this.isLoading() && !this.hasLoaded());
        },
        loadAll: function () {
            var headerInfo = {
                Authorization:$AuthService.getAppToken()
            };
            $rootScope.APP_STATUS = 'fetching resources...';
            $rootScope.resourceLoading = true;
            var promise = $http({
                method: 'GET',
                url: apiPath+'app/dashboard/resources',
                headers: headerInfo
            }).then(function successCallback(response) {
                $rootScope.resources = response.data.data.resources;
                $rootScope.authUser = response.data.data.authUser;
                $rootScope.AUTH_TOKEN = response.data.access_token;
                $rootScope.resourceLoading = false;
            }, function errorCallback(response) {
                $rootScope.resourceLoading = false;
                return response;
            });

            return promise;
        }
    }
});