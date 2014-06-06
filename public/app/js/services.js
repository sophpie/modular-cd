'use strict';

/* Services */

var services = angular.module('myApp.services', ['ngResource']).value('version', '0.1');


services.factory('Environment_Srv',['$resource',
    function($resource){
		return $resource('http://api.cronus.dev/environment/:id', {id: '@id'});
	}
]);


services.factory('EnvironmentList_Srv',['Environment_Srv','$q',
    function(Environment_Srv,$q){
		return function () {
			var delay = $q.defer();
			Environment_Srv.get(
					function (environment) {
						delay.resolve(environment);
					},
					function () {
						delay.reject('Cannot load environment');
					}
			);
			return delay.promise;
		}
}]);
