'use strict';

/* Controllers */

// EnvironmentController
function Environment_Ctrl($scope, EnvironmentRsc,Device) {
	$scope.environmentList = EnvironmentRsc.get(function(list){
		var defaultId = list.environments[0].id;
		$scope.getEnvironment(defaultId);
	});
}

//EnvironmentController
function EnvironmentCtrl($scope, EnvironmentRsc,$routeParams,$location,$http) {
	$scope.environmentList = EnvironmentRsc.get();
	if (typeof $routeParams.id == 'undefined') {
		$scope.environment = new EnvironmentRsc;
		$scope.environment.name = 'New environment';
	}
	else {
		$scope.environment = EnvironmentRsc.get({id:$routeParams.id});
	}
	
	$http({method:'GET',url:'http://api.cronus.dev/info/device'})
		.success(function(list,status,headers,config){
			$scope.availableDevices = list.availableDevices;
		}
	);
	
	$scope.submitEnvironment = function(){
		if ($scope.environment.id)
			$scope.environment.$update(function (data){
				$scope.environmentList = EnvironmentRsc.get();
			});
		else $scope.environment.$save(function (env){
			$scope.environmentList = EnvironmentRsc.get();
			$location.path('/environment/' + env.id);
		});
	}
	
	
	$scope.delete = function(){
		if ($scope.environment.id)
			$scope.environment.$remove(function (data){
				$scope.environmentList = EnvironmentRsc.get();
			});
	}
}
//Device controller
function DeviceCtrl($scope, EnvironmentRsc,DeviceRsc,$routeParams,$location,$http,$interval) {
	$scope.environmentList = EnvironmentRsc.get();
	$scope.environment = EnvironmentRsc.get({id:$routeParams.envId});
	if (typeof $routeParams.deviceId == 'undefined') {
		$scope.device = new DeviceRsc;
		$scope.device.deviceType = $routeParams.deviceType;
		$scope.device.environment = {id : $routeParams.envId };
	}
	else {
		$scope.device = DeviceRsc.get({id:$routeParams.deviceId});
	}
	
	$scope.submit = function(){
		if ($scope.device.id)
			$scope.device.$update();
		else $scope.device.$save(function(device){
			$location.path('/device/' + $routeParams.deviceType + '/' + $scope.environment.id + '/' + device.id);
		});
	}
	
	$scope.delete = function(){
		if ($scope.device.id)
			$scope.device.$remove(function (data){
				$location.path('/environment/' + $scope.environment.id);
			});
	}
	
	$scope.launchBuild = function(){
		$http({method:'GET',url:'http://api.cronus.dev/jenkins-job/' + $scope.device.id + '/launch'})
			.success(function(list,status,headers,config){
				
			}
		;
	}
};

function MyCtrl2() {
}
MyCtrl2.$inject = [];
