'use strict';


// Declare app level module which depends on filters, and services
var myApp = angular.module('myApp', ['myApp.filters', 'myApp.services', 'myApp.directives','jenkins','ngRoute']);

myApp.config(['$routeProvider', function($routeProvider) {
	//Environments
    $routeProvider.when('/environments', {
    	templateUrl: 'partials/environments.html', 
    	controller: Environment_Ctrl
    });
    $routeProvider.when('/environment/:id?', {
    	templateUrl: 'partials/environment/get.html', 
    	controller: EnvironmentCtrl
    });
    //Device
    $routeProvider.when('/device/:deviceType/:envId/:deviceId?', {
    	templateUrl: 'partials/devices/get.html', 
    	controller: DeviceCtrl
    });
    $routeProvider.when('/home', {templateUrl: 'partials/home.html', controller: MyCtrl2});
    $routeProvider.otherwise({redirectTo: '/view1'});
  }]);
