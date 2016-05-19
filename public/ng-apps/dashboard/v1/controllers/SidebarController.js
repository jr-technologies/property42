/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');

app.controller("SidebarController",["$scope", "$rootScope", function ($scope, $rootScope) {
    var contentHeader = {
        title: $rootScope.html_title
    };

    $scope.getForSaleProperties = function () {
        $rootScope.searchPropertiesParams.purpose_id = 1;
        $rootScope.$broadcast('searchPropertiesParamsChanged');
    }
    $scope.getForRentProperties = function () {
        $rootScope.searchPropertiesParams.purpose_id = 2;
        $rootScope.$broadcast('searchPropertiesParamsChanged');
    }
}]);