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
        $scope.html_title = "Property42 | Add Property";
        $scope.formSubmitStatus = '';
        $scope.property = property;
        $scope.types = $rootScope.resources.propertyTypes;
        $scope.subTypes = $rootScope.resources.propertySubTypes;
        $scope.blocks = [];
        $scope.societies = $rootScope.resources.societies;
        $scope.landUnits = $rootScope.resources.landUnits;
        $scope.features = [];
        $scope.featureSections = [];
        $scope.errors = [];
        $scope.propertyDocuments = {};

        $scope.temp = {
            society: property.location.society,
            block: property.location.block
        };
        $scope.$watch('temp.society', function() {
            $scope.form.data.society = $scope.temp.society.id;
            getBlocks().then(function (blocks) {
                $scope.blocks = blocks;
            });
        });
        $scope.$watch('temp.block', function() {
            $scope.form.data.block = $scope.temp.block.id;
        });

        $scope.societySelected = function ($item) {
            //
        };
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
                propertyId: property.id,
                propertyPurpose: 1,
                propertyType :property.type.parentType.id,
                propertySubType :property.type.subType.id,
                society:property.location.society.id,
                block: property.location.block.id,
                price: property.price,
                landArea: parseInt(property.land.area),
                landUnit: property.land.unit.id+'',
                propertyTitle: property.title,
                propertyDescription: property.description,
                features:getPropertyFeatures(),
                files : {},
                deletedFiles: [],
                owner: property.owner.id+"",
                contactPerson: property.owner.fName+' '+property.owner.lName,
                phone: property.phone,
                cell : property.mobile,
                email: property.email,
                fax: property.fax
            }
        };
        $scope.cancelFile = function (fileNumber) {
            switch (fileNumber)
            {
                case 0:
                    var file = $scope.form.data.files.mainFile;
                    file.file = null;
                    file.title = '';
                    console.log($.inArray(file.id, $scope.form.data.deletedFiles));
                    if($.inArray(file.id, $scope.form.data.deletedFiles) == -1){
                        $scope.form.data.deletedFiles.push(file.id);
                    }
                    break;
                case 1:
                    var file = $scope.form.data.files.twoFile;
                    file.file = null;
                    file.title = '';
                    if($.inArray(file.id, $scope.form.data.deletedFiles) == -1){
                        $scope.form.data.deletedFiles.push(file.id);
                    }
                    break;
                case 2:
                    var file = $scope.form.data.files.threeFile;
                    file.file = null;
                    file.title = '';
                    if($.inArray(file.id, $scope.form.data.deletedFiles) == -1){
                        $scope.form.data.deletedFiles.push(file.id);
                    }
                    break;
                case 3:
                    var file = $scope.form.data.files.fourFile;
                    file.file = null;
                    file.title = '';
                    if($.inArray(file.id, $scope.form.data.deletedFiles) == -1){
                        $scope.form.data.deletedFiles.push(file.id);
                    }
                    break;
                case 4:
                    var file = $scope.form.data.files.fiveFile;
                    file.file = null;
                    file.title = '';
                    if($.inArray(file.id, $scope.form.data.deletedFiles) == -1){
                        $scope.form.data.deletedFiles.push(file.id);
                    }
                    break;
                case 5:
                    var file = $scope.form.data.files.sixFile;
                    file.file = null;
                    file.title = '';
                    if($.inArray(file.id, $scope.form.data.deletedFiles) == -1){
                        $scope.form.data.deletedFiles.push(file.id);
                    }
                    break;
            }
        };

        var getPropertyDocuments = function () {
            return {
                mainFile:getPropertyMainDocument(),
                twoFile:getPropertyDocument(0),
                threeFile:getPropertyDocument(1),
                fourFile:getPropertyDocument(2),
                fiveFile:getPropertyDocument(3),
                sixFile:getPropertyDocument(4)
            };
        };
        var getPropertyMainDocument = function () {
            var document = {id:0,path: '#',title: '',main: 1};
            angular.forEach($scope.property.documents, function (doc, key) {
                if(doc.main == 1){
                    document.id = doc.id;
                    document.path = domain+'temp/'+doc.path;
                    document.title = doc.title;
                }
            });
            return document;
        };
        var getPropertyDocument = function (index){
            var document = {id:0,path: '#',title: '',main: 0};
            var otherDocuments = [];
            angular.forEach($scope.property.documents, function (doc, key) {
                if(doc.main != 1)
                    otherDocuments.push(doc)
            });

            if(otherDocuments[index] != undefined){
                doc = otherDocuments[index];
                document.id = doc.id;
                document.path = domain+'temp/'+doc.path;
                document.title = doc.title;
            }

            return document;
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
            console.log($scope.form.data.files);
            $rootScope.please_wait_class = 'please-wait';
            var upload = Upload.upload({
                url: apiPath+'property/update',
                data: $scope.form.data
            });

            upload.then(function (response) {
                $rootScope.please_wait_class = '';
                $window.scrollTo(0, 0);
                $scope.formSubmitStatus = '';
                $scope.propertyDocuments = {};
                $scope.property = response.data.data.property;
                getPropertyDocsAndSetToScope();
                $scope.form.data.deletedFiles = [];
            }, function (response) {
                $rootScope.please_wait_class = '';
                $scope.errors = response.data.error.messages;
                $window.scrollTo(0, 0);
            }, function (evt) {
                $window.scrollTo(0, 0);
            });
        };

        var getBlocks = function () {
            return $http({
                method: 'GET',
                url: apiPath+'society/blocks',
                params:{society_id: $scope.form.data.society}
            }).then(function successCallback(response) {
                return response.data.data.blocks;
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

        var getPropertyDocsAndSetToScope = function () {
            $scope.propertyDocuments = getPropertyDocuments();
            $scope.form.data.files = {
                mainFile:{title: $scope.propertyDocuments.mainFile.title, file: null, main:1, id:$scope.propertyDocuments.mainFile.id},
                twoFile:{title: $scope.propertyDocuments.twoFile.title, file: null, main:0, id:$scope.propertyDocuments.twoFile.id},
                threeFile:{title: $scope.propertyDocuments.threeFile.title, file: null, main:0, id:$scope.propertyDocuments.threeFile.id},
                fourFile:{title: $scope.propertyDocuments.fourFile.title, file: null, main:0, id:$scope.propertyDocuments.fourFile.id},
                fiveFile:{title: $scope.propertyDocuments.fiveFile.title, file: null, main:0, id:$scope.propertyDocuments.fiveFile.id},
                sixFile:{title: $scope.propertyDocuments.sixFile.title, file: null, main:0, id:$scope.propertyDocuments.sixFile.id}
            };
        };
        $scope.initialize = function () {
            getPropertyDocsAndSetToScope();

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