var App = angular.module('App',['ngRoute']);

App.config(['$routeProvider', function($routeProvider) {
    $routeProvider.when('/foreigner', {
        templateUrl: 'templates/form-foreigner.html',
        controller: 'ctrlForeigner'
    });

    $routeProvider.otherwise({ redirectTo: '/' });
}]);

App.controller('ctrlHome', function($scope, $route, $routeParams, $location){
    $scope.$route = $route;
    $scope.$location = $location;
    $scope.$routeParams = $routeParams;
});

App.controller('ctrlForeigner', function($scope, $routeParams, $http, $sce){
    $scope.name = "ctrlForeigner";
    $scope.params = $routeParams;

    $scope.form = {
        show: true
    };
    $scope.paid = {
        form: '',
        show: false
    };

    $scope.changeArrivalMethod = function(){
        if($scope.data.arrival_method=='air'){
            $scope.data.rail_arrival_date = '';
            $scope.data.rail_arrival_time = '';
            $scope.data.rail_arrival_train_number = '';
            $scope.data.rail_arrival_number_persons = 0;
        }else{
            $scope.data.air_arrival_date = '';
            $scope.data.air_arrival_flight_from = '';
            $scope.data.air_arrival_time = '';
            $scope.data.air_arrival_flight_number = '';
            $scope.data.air_arrival_number_persons = 0;
        }
    };

    $scope.changeDeparturelMethod = function(){
        if($scope.data.departure_method=='air'){
            $scope.data.rail_departure_date = '';
            $scope.data.rail_departure_time = '';
            $scope.data.rail_departure_train_number = '';
            $scope.data.rail_departure_number_persons = 0;
        }else{
            $scope.data.air_departure_date = '';
            $scope.data.air_departure_flight_from = '';
            $scope.data.air_departure_time = '';
            $scope.data.air_departure_flight_number = '';
            $scope.data.air_departure_number_persons = 0;
        }
    };

    $scope.back = function(){
        $scope.paid.show = false;
        $scope.form.show = true;
    }

    $scope.submit = function(){
        $scope.form.show = false;
        $http({
            method:'post',
            url:'/kiform/foreigner',
            data:$scope.data
        }).success(function(response, status){
            $scope.paid.form = $sce.trustAsHtml(response.html);
            $scope.paid.show = true;
        });
    }
});