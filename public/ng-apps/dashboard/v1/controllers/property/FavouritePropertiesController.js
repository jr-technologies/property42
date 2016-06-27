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
app.controller("FavouritePropertiesController",["properties", "$q", "$CustomHttpService", "$window", "$scope", "$rootScope","$http","$location", "$state", "$stateParams", "$AuthService", function (properties, $q, $CustomHttpService, $window, $scope, $rootScope, $http, $location, $state, $stateParams, $AuthService) {
    $scope.html_title = "Property42 | Add Property";
    $scope.properties = properties;
    $scope.deletingPropertyId = 0;
    $scope.params = {
        userId: $rootScope.authUser.id,
        start : 0,
        limit: (isNaN($stateParams.limit))?'20':''+$stateParams.limit
    };
    $scope.deletingProperties = {
        ids: []
    };
    $scope.totalProperties = 0;
    $scope.pages = [];
    $scope.checkAllPropertiesChkbx = false;
    $scope.activePage = 1;
    $scope.fetchingProperties = false;
    $scope.$watch('checkAllPropertiesChkbx', function () {
        if($scope.checkAllPropertiesChkbx == true){
            $scope.checkAll();
        }else{
            $scope.unCheckAll();
        }
    });

    $scope.checkAll = function() {
        $scope.deletingProperties.ids = $scope.properties.map(function(item) { return item.id; });
    };
    $scope.unCheckAll = function() {
        $scope.deletingProperties.ids = [];
    };
    $scope.limitChanged = function () {
        page = (isNaN($stateParams.page))? 1: $stateParams.page;
        $location.path('/home/properties/favourites').search({page:page,limit:$scope.params.limit});
    };
    $scope.getProperties = function () {
        if($scope.fetchingProperties == true){
            $q(function(resolve, reject) {
                resolve($scope.properties);
            });
        }
        $scope.fetchingProperties = true;
        return $CustomHttpService.$http('GET', apiPath+'user/properties', $rootScope.searchPropertiesParams)
            .then(function successCallback(response) {
                $scope.fetchingProperties = false;
                return response.data.data;
            }, function errorCallback(response) {
                $rootScope.$broadcast('error-response-received',{status:response.status});
                return [];
            });
    };

    $scope.deleteProperty = function (propertyId) {
        $scope.deletingPropertyId = propertyId;
        return $CustomHttpService.$http('POST', apiPath+'favourite/property/delete', {
                propertyId: propertyId,
                searchParams: $scope.params
        }).then(function successCallback(response) {
            $rootScope.favouritesCount = response.data.data.favouritesCount;
            $scope.properties = response.data.data.properties;
            $scope.totalProperties = response.data.data.totalProperties;
            $scope.deletingPropertyId = 0;
        }, function errorCallback(response) {
            $scope.deletingPropertyId = 0;
            $rootScope.$broadcast('error-response-received',{status:response.status});
        });
    };

    $scope.setPage = function (page) {
        if(parseInt(page) < 1 || parseInt(page) > Math.ceil($scope.totalProperties/$rootScope.searchPropertiesParams.limit))
            return false;
        $scope.activePage = page;
        $location.path('/home/properties/favourites').search({page:page,limit:$scope.params.limit})
    };
    $scope.initialize = function () {
        $rootScope.loading_content_class = '';
    };
}]);