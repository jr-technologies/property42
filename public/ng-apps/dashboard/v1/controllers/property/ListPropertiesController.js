/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');
app.filter('roundup', function () {
    return function (value) {
        if(value > 0)
            return Math.ceil(value);
        else
            return 1;
    };
});
app.controller("ListPropertiesController",["$q", "$window", "$scope", "$rootScope","$http", "$state", "$AuthService", function ($q, $window, $scope, $rootScope, $http, $state, $AuthService) {
    console.log($rootScope.authUser);
    $scope.html_title = "Property42 | Add Property";
    $scope.activeStatus = 1;
    $scope.properties = [];
    $scope.deletingPropertyId = 0;
    $scope.deletingProperties = {
        ids: []
    };
    $scope.totalProperties = 0;
    $scope.pages = [];
    $scope.checkAllPropertiesChkbx = false;
    $scope.activePage = 1;
    $scope.fetchingProperties = false;

    $scope.$on('searchPropertiesParamsChanged', function () {
        $rootScope.loading_content_class = 'loading-content';
        $scope.getProperties().then(function successCallback(data) {
            $scope.properties = data.properties;
            $scope.totalProperties = data.totalProperties;
            $scope.checkAllPropertiesChkbx = false;
            $rootScope.loading_content_class = '';
            $window.scrollTo(0,0);
        }, function errorCallback(response) {

        });
    });

    $scope.setPropertyStatus = function (status) {
        $scope.activeStatus = status;
        $rootScope.searchPropertiesParams.status_id = status;
        console.log($rootScope.searchPropertiesParams);
        $rootScope.$broadcast('searchPropertiesParamsChanged');
    };

    $scope.$watch('checkAllPropertiesChkbx', function () {
        if($scope.checkAllPropertiesChkbx == true){
            $scope.checkAll();
        }else{
            $scope.unCheckAll();
        }
    });

    $scope.$watchGroup(['totalProperties', 'searchPropertiesParams.limit'], function(newValues, oldValues, scope) {
        var pages = [];
        for(var i = 0; i < $scope.totalProperties / $rootScope.searchPropertiesParams.limit; i++){
            pages.push(i+1);
        }
        $scope.pages = pages;
        $scope.activePage = 1;
    });

    $scope.$watchGroup(['searchPropertiesParams.owner_id', 'searchPropertiesParams.limit'], function(newValues, oldValues, scope) {
        $rootScope.$broadcast('searchPropertiesParamsChanged');
    });

    $scope.checkAll = function() {
        $scope.deletingProperties.ids = $scope.properties.map(function(item) { return item.id; });
    };
    $scope.unCheckAll = function() {
        $scope.deletingProperties.ids = [];
    };
    $scope.getProperties = function () {
        if($scope.fetchingProperties == true){
            $q(function(resolve, reject) {
                resolve($scope.properties);
            });
        }
        $scope.fetchingProperties = true;
        return $http({
            method: 'GET',
            url: apiPath+'user/properties',
            params: $rootScope.searchPropertiesParams,
            headers: {
                Authorization:$AuthService.getAppToken()
            }
        }).then(function successCallback(response) {
            $scope.fetchingProperties = false;
            return response.data.data;
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

    $scope.filtersChanged = function () {
        $rootScope.$broadcast('searchPropertiesParamsChanged');
    };
    $scope.deleteProperty = function ($index) {
        $scope.deletingPropertyId = $scope.properties[$index].id;
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
            $scope.properties = response.data.data.properties;
            $scope.totalProperties = response.data.data.totalProperties;
            $scope.deletingPropertyId = 0;
        }, function errorCallback(response) {
            $scope.deletingPropertyId = 0;
            $rootScope.$broadcast('error-response-received',{status:response.status});
        });
    };
    $scope.deleteProperties = function () {
        return $http({
            method: 'POST',
            url: apiPath+'properties/delete',
            data:{
                propertyIds: $scope.deletingProperties.ids,
                searchParams: $rootScope.searchPropertiesParams
            }
        }).then(function successCallback(response) {
            $scope.deletingProperties.ids = [];
            $rootScope.propertiesCounts = response.data.data.propertiesCounts;
            $scope.properties = response.data.data.properties;
            $scope.totalProperties = response.data.data.totalProperties;
        }, function errorCallback(response) {
            $rootScope.$broadcast('error-response-received',{status:response.status});
        });
    };

    $scope.setPage = function (page) {
        if(parseInt(page) < 1 || parseInt(page) > Math.ceil($scope.totalProperties/$rootScope.searchPropertiesParams.limit))
            return false;

        var start = ($rootScope.searchPropertiesParams.limit * parseInt(page)) - $rootScope.searchPropertiesParams.limit;
        $rootScope.searchPropertiesParams.start = start;
        $rootScope.$broadcast('searchPropertiesParamsChanged');
        $scope.activePage = page;
    };
    $scope.initialize = function () {

        getPropertiesCounts().then(function successCallback(counts) {
            $rootScope.propertiesCounts = counts;
        }, function errorCallback(response) {

        });

        $rootScope.searchPropertiesParams.status_id = $rootScope.resources.propertyStatuses[0].id;
        $rootScope.searchPropertiesParams.owner_id = $rootScope.authUser.id+'';
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