/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');
app.directive('filterList', function($timeout) {
    return {
        link: function(scope, element, attrs) {

            var li = Array.prototype.slice.call(element[0].children);

            function filterBy(value) {
                li.forEach(function(el) {
                    el.className = el.textContent.toLowerCase().indexOf(value.toLowerCase()) !== -1 ? '' : 'ng-hide';
                });
            }

            scope.$watch(attrs.filterList, function(newVal, oldVal) {
                if (newVal !== oldVal) {
                    filterBy(newVal);
                }
            });
        }
    };
});
app.controller("SidebarController",["$scope", "$rootScope", function ($scope, $rootScope) {
    var contentHeader = {
        title: $rootScope.html_title
    };
}]);