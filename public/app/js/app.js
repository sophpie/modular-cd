'use strict';


// Declare app level module which depends on filters, and services
var myApp = angular.module('myApp', ['myApp.filters', 'myApp.services', 'myApp.directives']);

myApp.config(['$routeProvider', function($routeProvider) {
	//Environments
    $routeProvider.when('/environments', {
    	templateUrl: 'partials/environments.html', 
    	controller: Environment_Ctrl,
    	resolve : {
    		environmentList_resolve : function (EnvironmentList_Srv) {
    			return EnvironmentList_Srv();
    		}
    	}
    });
    $routeProvider.when('/home', {templateUrl: 'partials/home.html', controller: MyCtrl2});
    $routeProvider.otherwise({redirectTo: '/view1'});
  }]);
