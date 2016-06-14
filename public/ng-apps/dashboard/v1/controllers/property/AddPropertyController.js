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
                console.log(subTypeId);
                filtered.push(feature);
            }
        });
        return filtered;
    };
}]);

app.controller("AddPropertyController",["$scope", "$rootScope", "$window","$http", "Upload","$sce", function ($scope, $rootScope, $window, $http, Upload, $sce) {
    $scope.html_title = "Property42 | Add Property";
    $scope.formSubmitStatus = '';
    $scope.propertySaved = false;
    $scope.types = $rootScope.resources.propertyTypes;
    $scope.subTypes = $rootScope.resources.propertySubTypes;
    $scope.blocks = [];
    $scope.societies = $rootScope.resources.societies;
    $scope.subTypeAssignedFeatures = [];
    $scope.heighPriorityFeatures = [];
    $scope.features = [];
    $scope.featureSections = [];
    $scope.errors = [];
    $scope.temp = {
        society: {id:0},
        block: {id:0}
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
    $scope.form = {
        data : {}
    };
    var mapFormData = function () {
      return {
          propertyPurpose: 0,
          propertyType :0,
          propertySubType : 0,
          society:0,
          block: 0,
          price: null,
          landArea: null,
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
              sixFile:{title: '', file: null}
          },
          owner: $rootScope.authUser.id+"",
          contactPerson: $rootScope.authUser.fName+" "+$rootScope.authUser.lName,
          phone: $rootScope.authUser.phone,
          cell : $rootScope.authUser.mobile,
          fax: $rootScope.authUser.fax,
          email: $rootScope.authUser.email
      }
    };
    $scope.$watch('form.data.propertySubType', function (subTypeId) {
        var heighPriorityFeatures = [];
        angular.forEach($rootScope.resources.subTypeAssignedFeatures, function (features, key) {
            if(features.subTypeId == subTypeId){
                $scope.subTypeAssignedFeatures = $.map(features.features, function(value, index) {
                    return [value];
                });
                $scope.subTypeAssignedFeatures = $scope.subTypeAssignedFeatures.sort(function(a,b){
                    return b.features.length - a.features.length;
                });
            }
        });
    });
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
        $scope.propertySaved = false;
        $scope.errors = {};
        $rootScope.please_wait_class = 'please-wait';
        var upload = Upload.upload({
            url: apiPath+'property',
            data: $scope.form.data
        });

        upload.then(function (response) {
            $rootScope.please_wait_class = '';
            $window.scrollTo(0, 0);
            $scope.propertySaved = true;
            resetForm();
        }, function (response) {
            $rootScope.please_wait_class = '';
            $scope.errors = response.data.error.messages;
            $window.scrollTo(0, 0);
        }, function (evt) {
            $window.scrollTo(0, 0);
            console.log(evt);
        });
    };

    var resetForm = function () {
        $scope.form.data = mapFormData();
        $('.image-loaded').removeClass('image-loaded');
        $('file-uploader').find('img').attr('src', '#');
    };

    var getBlocks = function () {
        alert();
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


    $scope.initialize = function () {
        $rootScope.loading_content_class = '';
        $scope.form.data = mapFormData();

        $(function() {
            handleAddPropertyFormScrolling();
            $('.feature-block').find('.holder').hide();
            $('.feature-block').find('.form-heading').hide();
        });

    };
}]);