var app = angular.module('myApp', []);

app.controller('MyController', function($scope, $http, $compile){
	$scope.makeClick = function(event){
		var $elem = angular.element(event.currentTarget);
		$http.get('data.json').success(function(res){
			$elem.replaceWith($compile(res)($scope));
		});
	};
});