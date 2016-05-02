(function () { 'use strict';}());

angular.module('framework').directive('dialog', function($rootScope, $document, $timeout) {
	return {
		restrict: 'E',
		replace: true,
		scope: true,
		templateUrl: 'directive/dialog/dialog.html',
		link: function() {
		},
		controller: function($scope){

			$scope.dialogKeyPress = function(key){
				if($scope.dialog && $scope.dialog.comment_rule !== 'optional' || $scope.dialog.comment_rule !== 'required')
				{
					if(key === 13){
						$scope.confirmDialog();
					}
					else if (key === 27){
						$scope.cancelDialog();
					}
				}
				else {
					return null;
				}
			};

			var keyboardShortcutHandler = function(e) {
				$timeout($scope.dialogKeyPress(e.which));
			};
			$rootScope.createDialog = function(dialogOptions){
				$rootScope.dialogActive = true;
				$scope.dialog = {
					title: dialogOptions.title,
					content: dialogOptions.content,
					use_text_area: dialogOptions.use_text_area || false,
					comment_rule: dialogOptions.comment_rule || 'disabled',
					confirm_text: dialogOptions.confirm_text || 'CONFIRM',
					confirm_class: dialogOptions.confirm_class || 'primary',
					hide_cancel_btn: dialogOptions.hide_cancel_btn || false,
					onConfirm: dialogOptions.onConfirm,
					onCancel: dialogOptions.onCancel
				};

				$timeout(function(){
					$document.bind('keyup', keyboardShortcutHandler);
				}, 100);

			};
			$scope.destroyDialog = function(){
				$document.unbind('keyup', keyboardShortcutHandler);
				$timeout(function(){
					$rootScope.dialogActive = false;
					$scope.dialog = null;
				});
			};
			$rootScope.cancelDialog = function(){
				if($scope.dialog.onCancel){
					$scope.dialog.onCancel();
				}
				$scope.destroyDialog();
			};
			$scope.confirmDialog = function(){
				if($scope.dialog.onConfirm) {
					if ($scope.dialog.comment_rule === 'optional' || $scope.dialog.comment_rule === 'required') {
						$scope.dialog.onConfirm($scope.dialog.comments);
						$scope.destroyDialog();
					}
					else {
						$scope.dialog.onConfirm();
						$scope.destroyDialog();
					}
				}
				$scope.destroyDialog();
			};
		}
	};
});
