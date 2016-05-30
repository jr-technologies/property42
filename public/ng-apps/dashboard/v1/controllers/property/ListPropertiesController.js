/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');
app.controller("ListPropertiesController",["$scope", "$rootScope","$http", "$state", "$AuthService", function ($scope, $rootScope, $http, $state, $AuthService) {

    $scope.html_title = "Property42 | Add Property";
    $scope.activeStatus = 1;
    $scope.properties = [];
    $scope.$on('searchPropertiesParamsChanged', function () {
        getProperties().then(function successCallback(properties) {
            $scope.properties = properties;
        }, function errorCallback(response) {

        });
    });

    $scope.setPropertyStatus = function (status) {
        $scope.activeStatus = status;
        $rootScope.searchPropertiesParams.status_id = status;
        $rootScope.$broadcast('searchPropertiesParamsChanged');
    };

    var getProperties = function () {
        return $http({
            method: 'GET',
            url: apiPath+'user/properties',
            params: $rootScope.searchPropertiesParams,
            headers: {
                Authorization:$AuthService.getAppToken()
            }
        }).then(function successCallback(response) {
            return response.data.data.properties;
        }, function errorCallback(response) {
            $rootScope.$broadcast('error-response-received',{status:response.status});
            return [];
        });
    };
    var getPropertiesCounts = function () {
        return $http.get(apiPath+'properties/count', {
            params: {
                user_id: $rootScope.authUser.id
            }
        }).then(function successCallback(response) {
            return response.data.data.counts;
        }, function errorCallback(response) {
            return response;
        });
    };

    $scope.deleteProperty = function ($index) {
        return $http({
            method: 'POST',
            url: apiPath+'property/delete',
            data:{
                propertyId: $scope.properties[$index].id,
                searchParams: $rootScope.searchPropertiesParams
            }
        }).then(function successCallback(response) {
            $scope.properties.splice($index, 1);
            $rootScope.propertiesCounts = response.data.data.propertiesCounts;
        }, function errorCallback(response) {
            $rootScope.$broadcast('error-response-received',{status:response.status});
        });
    };
    $scope.initialize = function () {

        getPropertiesCounts().then(function successCallback(counts) {
            $rootScope.propertiesCounts = counts;
        }, function errorCallback(response) {

        });

        $rootScope.searchPropertiesParams.status_id = $rootScope.resources.propertyStatuses[0].id;
        $rootScope.searchPropertiesParams.owner_id = $rootScope.authUser.id;
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