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

app.controller("EditPropertyController",["$scope", "$rootScope", "$window","$http", "Upload","$sce", "$state", "$AuthService",
    function ($scope, $rootScope, $window, $http, Upload, $sce, $state, $AuthService){
    $scope.html_title = "Property42 | Add Property";
    $scope.property = null;
    $scope.formSubmitStatus = '';
    $scope.types = [];
    $scope.subTypes = [];
    $scope.blocks = [];
    $scope.societies = [];
    $scope.features = [];
    $scope.featureSections = [];
    $scope.errors = [];
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
                sixFile:{title: '', file: null}
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

    var getProperty = function () {
        return $http({
            method: 'GET',
            url: apiPath+'user/properties',
            params: {property_id: $state.params.propertyId},
            headers: {
                Authorization:$AuthService.getAppToken()
            }
        }).then(function successCallback(response) {
            return response.data.data.properties[0];
        }, function errorCallback(response) {
            $rootScope.$broadcast('error-response-received',{status:response.status});
            return undefined;
        });
    };

    $scope.initialize = function () {
        getProperty().then(function successCallback(response) {
            if(response == undefined)
            {
                
            }
        }, function errorCallback(response) {
            console.log(response);
        });
        $(function() {
            handleAddPropertyFormScrolling();
            $('.feature-block').find('.holder').hide();
            $('.feature-block').find('.form-heading').hide();
        });
    };
}]);