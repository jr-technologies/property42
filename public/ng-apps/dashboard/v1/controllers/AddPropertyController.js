/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');


app.controller("AddPropertyController",["$scope","$http", "Upload", function ($scope, $http, Upload) {
    $scope.html_title = "Property42 | Add Property";

    $scope.types = [];
    $scope.subTypes = [];
    $scope.blocks = [];
    $scope.societies = [];
    $scope.features = [];

    $scope.selectedType = 1 ;
    $scope.selectedSubTypeId = 0;
    $scope.propertySociety = 0;
    $scope.files = {
        mainFile : {
            title: '',
            file: null
        },
        secondFile : null,
        thirdFile : null
    };

    $scope.cancelFile = function (fileNumber) {
        switch (fileNumber)
        {
            case 0:
                $scope.files.mainFile.file = null;
                break;
            case 1:
                $scope.files.secondFile = null;
                break;
            case 2:
                $scope.files.thirdFile = null;
                break;
        }
    };

    $scope.submitProperty = function() {
        var upload = Upload.upload({
            url: apiPath+'test/ng',
            data: {
                userName: 'noman tufail',
                file: $scope.files
            }
        });

        upload.then(function (response) {
            console.log(response);
        }, function (response) {
            console.log(response);
        }, function (evt) {
            console.log(evt);
        });
    };

    var getTypes = function () {
        return $http({
            method: 'GET',
            url: apiPath+'property/types',
            data:{}
        }).then(function successCallback(response) {
            return response.data.data.propertyTypes;
        }, function errorCallback(response) {
            return response;
        });
    };

    var getSubTypes = function () {
        return $http({
            method: 'GET',
            url: apiPath+'property/subtypes',
            data:{}
        }).then(function successCallback(response) {
            return response.data.data.propertySubTypes;
        }, function errorCallback(response) {
            return response;
        });
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

    var getAssignedFeatures = function () {
        return $http({
            method: 'GET',
            url: apiPath+'features/assigned',
            data:{}
        }).then(function successCallback(response) {
            return response.data.data.features;
        }, function errorCallback(response) {
            return response;
        });
    };

    $scope.initialize = function () {
        getTypes().then(function successCallback(types) {
            $scope.types = types;
        }, function errorCallback(response) {
            console.log('fucked up');
        });
        getSubTypes().then(function successCallback(types) {
            $scope.subTypes = types;
        }, function errorCallback(response) {
            console.log('fucked up');
        });
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

        getAssignedFeatures().then(function successCallback(features) {
            $scope.features = features;
        }, function errorCallback(response) {
            console.log('fucked up');
        });

        getAssignedFeatures();

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

    };
}]);