/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');

app.controller("ChangePasswordController",["$scope", "$rootScope","$http", "$state", "$AuthService", function ($scope, $rootScope, $http, $state, $AuthService) {
    $scope.html_title = "Property42 | Change Password";
    $scope.errors = {};
    $scope.form = {
        data : {
            userId: $rootScope.authUser.id,
            existingPassword: '',
            newPassword: ''
        }
    };

    $scope.changePassword = function () {
        $scope.errors = {};
        $rootScope.loading_content_class = 'loading-content';
        $http.post(apiPath+'user/change-password', $scope.form.data)
            .then(function (response) {
            $scope.errors = {};
            $rootScope.loading_content_class = '';
        }, function (response) {
            $rootScope.loading_content_class = '';
            $scope.errors = response.data.error.messages;
            $rootScope.$broadcast('error-response-received',{status:response.status});
        }, function (evt) {

        });
    };

    $scope.initialize = function () {

    };
}]);