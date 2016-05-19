/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');
app.controller("ListPropertiesController",["$scope", "$rootScope","$http", function ($scope, $rootScope, $http) {
    //console.log($rootScope.searchPropertiesParams);
    $scope.html_title = "Property42 | Add Property";
    $scope.properties = '';

    var getProperties = function () {
        return $http.get(apiPath+'user/properties', {
                params: $rootScope.searchPropertiesParams
            }).then(function successCallback(response) {
            return response.data.data.properties;
        }, function errorCallback(response) {
            return response;
        });
    };

    $scope.initialize = function () {
        getProperties().then(function successCallback(properties) {
            console.log(properties);
            $scope.properties = properties;
        }, function errorCallback(response) {
            console.log('fucked up');
        });
    };
}]);