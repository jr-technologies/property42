/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('inventory_system');

app.controller("AddCustomersController",["$scope","$http", function ($scope, $http) {
    $scope.contentHeader.title = "Add a new Customer";
}]);