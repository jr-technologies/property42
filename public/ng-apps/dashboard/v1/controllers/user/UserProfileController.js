/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');

app.controller("UserProfileController",["user", "$scope", "$rootScope","$http", "$state", "$AuthService", function (user, $scope, $rootScope, $http, $state, $AuthService) {
    var idForAgentBroker = 3;
    $scope.html_title = "Property42 | My Profile";
    $scope.user = user;
    $scope.userIsAgent = false;

    var getUserRolesIds = function () {
        var ids = [];
        angular.forEach($scope.user.roles, function (role, key) {
            ids.push(role.id);
        });
        return ids;
    };

    $scope.form = {
        data : {
            roles: getUserRolesIds()
        }
    };

    $scope.updateUser = function () {
        console.log($scope.form.data);
    };
    $scope.$watch('form.data.roles.length', function (totalRoles) {
        //console.log($scope.form.data.roles);
        var isAgent = false;
        angular.forEach($scope.form.data.roles, function (role, key) {
            if(role == idForAgentBroker){
                isAgent = true;
            }
        });
        $scope.userIsAgent = isAgent;
    });
    $scope.$watch('userIsAgent', function (userIsAgent) {
        if(userIsAgent){
            var index = $scope.form.data.roles.indexOf(idForAgentBroker);
            if (index <= -1) {
                $scope.form.data.roles.push(idForAgentBroker);
            }
        }else{
            var index = $scope.form.data.roles.indexOf(idForAgentBroker);
            if (index > -1) {
                $scope.form.data.roles.splice(index, 1);
            }
        }
    });
    $scope.initialize = function () {
        $('.registration-form').find('.role-listing').hide();
    };
}]);