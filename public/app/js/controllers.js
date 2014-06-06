'use strict';

/* Controllers */

//EnvironmentController
function Environment_Ctrl($scope,environmentList_resolve){
	$scope.environmentList = environmentList_resolve;
	$scope.current_environment = $scope.environmentList.environments[0];
}


function MyCtrl2() {
}
MyCtrl2.$inject = [];
