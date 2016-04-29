/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');

app.controller("AddPropertyController",["$scope","$http", function ($scope, $http) {
    $scope.html_title = "Property42 | Add Property";

    $scope.propertySociety = 0;
    $scope.blocks = [];
    $scope.societies = [];

    $scope.select2Options = {
        allowClear:true
    };

    var getBlocks = function () {
        return $http({
            method: 'GET',
            url: apiPath+'blocks',
            data:{}
        }).then(function successCallback(response) {
            return response.data.data.blocks;
        }, function errorCallback(response) {
            return response;
        });
    };

    var getSocieties = function () {
        return $http({
            method: 'GET',
            url: apiPath+'societies',
            data:{}
        }).then(function successCallback(response) {
            return response.data.data.societies;
        }, function errorCallback(response) {
            return response;
        });
    };

    $scope.initialize = function () {
        getSocieties().then(function successCallback(societies) {
            $scope.societies = societies;
        }, function errorCallback(response) {
            console.log('fucked up');
        });

        getBlocks().then(function successCallback(blocks) {
            $scope.blocks = blocks;
        }, function errorCallback(response) {
            console.log('fucked up');
        });

        $(function() {
            handleAddPropertyFormScrolling();
        });

        $(".searchable-select").select2({
            placeholder: "Select",
            allowClear: true
        });

        // page init
        jQuery(function(){
            initTabs();
        });

        // content tabs init
        function initTabs() {
            jQuery('.tabset').contentTabs({
                tabLinks: 'a'
            });
        }
    };
}]);