(function () { 'use strict';}());

angular.module('framework', ['sticky','angular.filter', 'ngAnimate','ui.router','ngOrderObjectBy','duScroll', 'ng-token-auth', 'textAngular', '720kb.tooltips','ui.utils','ngAnimate', 'ngTable']);

angular.module('framework').run(function($rootScope, $document, $timeout) {
	$rootScope.safeApply = function(fn) {
		var phase = $rootScope.$$phase;
		if (phase === '$apply' || phase === '$digest') {
			if (fn && (typeof(fn) === 'function')) {
				fn();
			}
		} else {
			this.$apply(fn);
		}
	};

	$rootScope.$on('$stateChangeSuccess', function(){
		$document.scrollTopAnimated(0);
	});
	$rootScope.$on('duScrollspy:becameActive', function($event, $element, $target){
		$timeout(function(){
			$rootScope.current_section = $element.context.innerText;
		});
	});
});

angular.module('framework').value('duScrollActiveClass', 'active');
