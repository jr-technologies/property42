/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');
app.filter('propsFilter', function() {
    return function(items, props) {
        var out = [];

        if (angular.isArray(items)) {
            var keys = Object.keys(props);

            items.forEach(function(item) {
                var itemMatches = false;

                for (var i = 0; i < keys.length; i++) {
                    var prop = keys[i];
                    var text = props[prop].toLowerCase();
                    if (item[prop].toString().toLowerCase().indexOf(text) !== -1) {
                        itemMatches = true;
                        break;
                    }
                }

                if (itemMatches) {
                    out.push(item);
                }
            });
        } else {
            // Let the output be the input untouched
            out = items;
        }

        return out;
    };
});

app.controller("AddPropertyController",["$scope","$http", "Upload","$sce", function ($scope, $http, Upload, $sce) {
    $scope.html_title = "Property42 | Add Property";
    $scope.formSubmitStatus = '';
    $scope.types = [];
    $scope.subTypes = [];
    $scope.blocks = [];
    $scope.societies = [];
    $scope.features = [];

    $scope.temp = {
        society: {id:0},
        block: {id:0}
    };
    $scope.$watch('temp.society', function() {
        $scope.form.data.society = $scope.temp.society.id;
    });
    $scope.$watch('temp.block', function() {
        $scope.form.data.block = $scope.temp.block.id;
    });
    $scope.form = {
        data : {
            propertyPurpose: 0,
            propertyType :0,
            propertySubType : 0,
            society:0,
            block: 0,
            price: 0,
            landArea: 0,
            landUnit: 0,
            propertyTitle: '',
            propertyDescription: '',
            features:{},
            files : {
                mainFile:{title: '', file: null},
                twoFile:{title: '', file: null},
                threeFile:{title: '', file: null},
                fourFile:{title: '', file: null},
                fiveFile:{title: '', file: null},
                sixFile:{title: '', file: null},
                sevenFile:{title: '', file: null},
                eightFile:{title: '', file: null}
            },
            owner: 0,
            contactPerson: '',
            phone: "",
            cell : "",
            fax: "",
            email: ""
        }
    };
    var nullFile = {title: '', file: null};
    $scope.cancelFile = function (fileNumber) {
        switch (fileNumber)
        {
            case 0:
                $scope.form.data.files.mainFile = nullFile;
                break;
            case 1:
                $scope.form.files.data.files.secondFile = nullFile;
                break;
            case 2:
                $scope.form.files.data.files.thirdFile = nullFile;
                break;
        }
    };

    $scope.submitProperty = function() {
        $scope.formSubmitStatus = 'submiting'
        var upload = Upload.upload({
            url: apiPath+'test/ng',
            data: $scope.form.data
        });

        upload.then(function (response) {
            $scope.formSubmitStatus = '';
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