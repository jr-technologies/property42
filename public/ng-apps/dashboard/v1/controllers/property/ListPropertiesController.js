/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');
app.controller("ListPropertiesController",["$scope", "$rootScope","$http", "$state", function ($scope, $rootScope, $http, $state) {

    $scope.html_title = "Property42 | Add Property";
    $scope.activeStatus = 1;
    $scope.properties = [];
    $scope.$on('searchPropertiesParamsChanged', function () {
        getProperties().then(function successCallback(properties) {
            $scope.properties = properties;
        }, function errorCallback(response) {
            console.log('fucked up');
        });
    });

    $scope.setPropertyStatus = function (status) {
        $scope.activeStatus = status;
        $rootScope.searchPropertiesParams.status_id = status;
        $rootScope.$broadcast('searchPropertiesParamsChanged');
    };

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
        if($state.current.name == 'home.properties.all')
        {
            $rootScope.searchPropertiesParams.purpose_id = null;
        }
        else if($state.current.name == 'home.properties.for-sale')
        {
            $rootScope.searchPropertiesParams.purpose_id = 1;
        }
        else if($state.current.name == 'home.properties.for-rent')
        {
            $rootScope.searchPropertiesParams.purpose_id = 2;
        }
        $rootScope.$broadcast('searchPropertiesParamsChanged');
    };
}]);