/**
 * Created by zeenomlabs on 12/11/2015.
 */
var app = angular.module('dashboard');
app.factory("$ErrorResponseHandler", function ($rootScope, $http, $AuthService) {
    return {
        handle: function (status) {
            switch (status)
            {
                case 401:
                    alert('you should be logged out');
                    break;
                default :
                    break;
            }
        }
    }
});