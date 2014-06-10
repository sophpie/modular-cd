'use strict';

/* Services */

var services = angular.module('myApp.services', ['ngResource']);


services.factory('Environment_Srv',['$resource',
    function($resource){
		return $resource('http://api.cronus.dev/environment/:id', {id: '@id'});
	}
]);

services.factory('Device',['$resource',
                                    function($resource){
                                		return $resource('http://api.cronus.dev/device/:id', {id: '@id'});
                                	}
                                ]);

services.factory('EnvironmentList_Srv',['Environment_Srv','$q',
    function(Environment_Srv,$q){
		return function () {
			var envListDeffered = $q.defer();
			var defaultEnvId;
			Environment_Srv.get(
					function (envList) {
						defaultEnvId = envList.environments[0].id;
						envListDeffered.resolve(envList);
					},
					function () {
						envListDeffered.reject('Cannot load environment');
					}
			);
			var defaultEnvDeffered = $q.defer();
			envListDeffered.promise.then(function(d){
				Environment_Srv.get({id : defaultEnvId },
						function(currentEnv){
							defaultEnvDeffered.resolve(currentEnv);
						},
						function(){
							defaultEnvDeffered.reject('Cannot load first environment');
						}
				)
			});
			return {
				environmentList: envListDeffered.promise,
				defaultEnvironment: defaultEnvDeffered.promise
			}
		}
}]);
