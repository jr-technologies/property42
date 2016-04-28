/**
 * Created by zeenomlabs on 12/11/2015.
 */
var app = angular.module('inventory_system');
app.factory("$ResourceLoader", function ($rootScope, $http, $AuthService) {
    return {
        loadAll: function () {
            var headerInfo = {
                Authorization:$AuthService.getAppToken()
            };
            $rootScope.APP_STATUS = 'fetching users...';
            var promise = $http({
                method: 'GET',
                url: apiPath+'users',
                headers: headerInfo
            }).then(function successCallback(response) {
                $rootScope.USERS = response.data.data.users;
                $rootScope.APP_STATUS = 'fetching customers...';
                return $http({
                    method: 'GET',
                    url: apiPath+'customers',
                    headers: headerInfo
                });
            }, function errorCallback(response) {
                return false;
            }).then(function (response) {
                $rootScope.CUSTOMERS = response.data.data.customers;
                console.log($rootScope.CUSTOMERS);
                $rootScope.APP_STATUS = 'Routing back to home...';
                return true;
            }, function(response){
                alert('ooops :( system is unable to load your ')
                return false;
            });

            return promise;
        }
    }
});