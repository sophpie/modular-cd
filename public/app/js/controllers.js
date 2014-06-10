'use strict';

/* Controllers */

//EnvironmentController
function Environment_Ctrl($scope,Environment_Srv,environmentList_resolve,Device){
	$scope.environmentList = environmentList_resolve.environmentList;
	$scope.environment = environmentList_resolve.defaultEnvironment;
	$scope.deviceInfos = false;
	
	$scope.getEnvironment = function(id){
		Environment_Srv.get({id:id},
				function(environment){
					$scope.environment = environment;
				}
		);
	}
	
	$scope.getDevice = function (id){
		Device.get({id:id},
			function(device){
				$scope.deviceInfos = device;
			}
		);
	}
}


function MyCtrl2() {
}
MyCtrl2.$inject = [];
