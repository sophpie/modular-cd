'use strict';

/* Services */

var services = angular.module('myApp.services', [ 'ngResource' ]);

services.factory('EnvironmentRsc', [ '$resource', function($resource) {
	return $resource('http://api.cronus.dev/environment/:id', {
		id : '@id'
	}, {
		'update' : {
			method : 'PUT'
		}
	});
} ]);

services.factory('DeviceRsc', [ '$resource', function($resource) {
	return $resource('http://api.cronus.dev/device/:id', {
		id : '@id'
	}, {
		'update' : {
			method : 'PUT'
		}
	});
} ]);
