/**
 * Created by alexandr on 26.02.14.
 */

var Main = angular.module('main',['ngRoute'])
.controller('Container',function($scope, $window){
	$scope.click = function(){
		$window.alert('Click!');
	}
});