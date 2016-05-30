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

app.filter('filterBySubType', [function () {
    return function (features, subTypeId) {
        var filtered = [];
        angular.forEach(features, function (feature, key) {
            if(parseInt(feature.assignedSubTypeId) == parseInt(subTypeId)){
                filtered.push(feature);
            }
        });
        return filtered;
    };
}]);

app.controller("EditPropertyController",['property', "$scope", "$rootScope", "$window","$http", "Upload","$sce", "$state", "$AuthService", "$location",
    function (property, $scope, $rootScope, $window, $http, Upload, $sce, $state, $AuthService, $location){
        console.log(property);
        $scope.html_title = "Property42 | Add Property";
        $scope.formSubmitStatus = '';
        $scope.property = property;
        $scope.types = [];
        $scope.subTypes = [];
        $scope.blocks = [];
        $scope.societies = [];
        $scope.landUnits = $rootScope.resources.landUnits;
        $scope.features = [];
        $scope.featureSections = [];
        $scope.errors = [];
        $scope.temp = {
            society: {id:'1'},
            block: {id:'1'}
        };
        $scope.$watch('temp.society', function() {
            $scope.form.data.society = $scope.temp.society.id;
        });
        $scope.$watch('temp.block', function() {
            $scope.form.data.block = $scope.temp.block.id;
        });
        var getPropertyFeatures = function(){
            var sections = $scope.property.features;
            var finalFeatures = {};
            angular.forEach(sections, function (features, key) {
                angular.forEach(features, function (feature, key) {
                    finalFeatures[feature.inputName] = feature.value
                });
            });
            return finalFeatures;
        };
        $scope.form = {
            data : {
                propertyPurpose: 1,
                propertyType :property.type.parentType.id,
                propertySubType :property.type.subType.id,
                society:property.location.society.id,
                block: property.location.block.id,
                price: property.price,
                landArea: property.land.area,
                landUnit: property.land.unit.id+'',
                propertyTitle: property.title,
                propertyDescription: property.description,
                features:getPropertyFeatures(),
                files : {
                    mainFile:{title: '', file: null},
                    twoFile:{title: '', file: null},
                    threeFile:{title: '', file: null},
                    fourFile:{title: '', file: null},
                    fiveFile:{title: '', file: null},
                    sixFile:{title: '', file: null}
                },
                owner: property.owner.id+"",
                contactPerson: property.owner.fName+' '+property.owner.lName,
                phone: property.owner.phone,
                cell : property.owner.mobile,
                email: property.owner.email
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
                    $scope.form.files.data.files.twoFile = nullFile;
                    break;
                case 2:
                    $scope.form.files.data.files.threeFile = nullFile;
                    break;
                case 3:
                    $scope.form.data.files.fourFile = nullFile;
                    break;
                case 4:
                    $scope.form.files.data.files.fiveFile = nullFile;
                    break;
                case 5:
                    $scope.form.files.data.files.sixFile = nullFile;
                    break;
            }
        };

        var postProcessFormData = function () {
            var features = {};
            angular.forEach($scope.form.data.features, function(value, key) {
                if(value != false){ features[key] = value; }
            });
            $scope.form.data.features = features;
        };
        $scope.submitProperty = function() {
            postProcessFormData();
            $scope.errors = {};
            $rootScope.please_wait_class = 'please-wait';
            var upload = Upload.upload({
                url: apiPath+'property',
                data: $scope.form.data
            });

            upload.then(function (response) {
                $rootScope.please_wait_class = '';
                $window.scrollTo(0, 0);
                $scope.formSubmitStatus = '';
            }, function (response) {
                $rootScope.please_wait_class = '';
                $scope.errors = response.data.error.messages;
                $window.scrollTo(0, 0);
            }, function (evt) {
                $window.scrollTo(0, 0);
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

        var getFeatureSections = function () {
            return $http({
                method: 'GET',
                url: apiPath+'feature/sections',
                data:{}
            }).then(function successCallback(response) {
                return response.data.data.featureSections;
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

            getFeatureSections().then(function successCallback(sections) {
                $scope.featureSections = sections;
            }, function errorCallback(response) {
                console.log('fucked up');
            });


            $(function() {
                handleAddPropertyFormScrolling();
                $('.feature-block').find('.holder').hide();
                $('.feature-block').find('.form-heading').hide();
            });

        };
}]);