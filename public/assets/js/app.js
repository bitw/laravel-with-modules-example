/**
 * Created by alexandr on 26.02.14.
 */

var Main = angular.module('main',['ngRoute'])
.config(['$routeProvider',
function($routeProvider) {
    $routeProvider.
        when('/', {
            templateUrl: 'kiform/form-en_1.html',
            controller: 'PhoneListCtrl'
        }).
        when('/phones/:phoneId', {
            templateUrl: 'partials/phone-detail.html',
            controller: 'PhoneDetailCtrl'
        }).
        otherwise({
            redirectTo: '/'
        });
}])
.controller('container',function($scope, $window){
	$scope.click = function(){
		$window.alert('Click!');
	}
});