/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');
app.controller("FeedbackController",["$scope", "$rootScope", function ($scope, $rootScope) {
    $scope.errors = {};
    $scope.feedBackSent = false;
    $scope.form = {
        data:{
            email: '',
            message: ''
        }
    };
    $scope.sendFeedback = function () {
        $scope.feedBackSent = true;
        console.log($scope.form.data);
    }
}]);