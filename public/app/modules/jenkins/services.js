jenkinsModule.factory('Jenkins',[ '$resource', function($resource) {
		return $resource('http://api.cronus.dev/jenkins/:id', {id : '@id'});
	}]);