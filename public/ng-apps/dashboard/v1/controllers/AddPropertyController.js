/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');

app.controller("AddPropertyController",["$scope","$http", function ($scope, $http) {
    $scope.html_title = "Property42 | Add Property";

    $scope.initialize = function () {
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