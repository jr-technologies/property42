/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');

app.controller("HeaderController",["$scope", "$rootScope", "$location", "$state", function ($scope, $rootScope, $location, $state) {
    $scope.propertyId = '';
    $scope.searchProperty = function () {
        if(parseInt($scope.propertyId) > 0)
            $location.path('/home/properties/edit/'+$scope.propertyId);
        else
            alert($scope.propertyId+' is not a valid property id.');
    }
}]);