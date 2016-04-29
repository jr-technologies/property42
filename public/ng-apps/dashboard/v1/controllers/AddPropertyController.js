/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');

app.controller("AddPropertyController",["$scope","$http", function ($scope, $http) {
    $scope.html_title = "Property42 | Add Property";


    $scope.blocks = [];
    var getBlocks = function () {
        /*$http({
         method: 'GET',
         url: apiPath+'blocks',
         data:{}
         }).then(function successCallback(response) {
         console.log(response);
         }, function errorCallback(response) {
         console.log(response);
         });*/
    };
    $scope.initialize = function () {

        $scope.blocks = getBlocks();
        console.log($scope.blocks);

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