"use strict'";

define(["app"], function (app) {

    app.register.controller("ErrorController", ["$scope", "head", function ($scope, head) {
    	$scope.title = head.title("Dang It!");
    }]);

});