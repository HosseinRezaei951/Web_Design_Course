var app = angular.module('WorkSamplesApp', []);

app.controller('WorkSamplesController', function($scope, $http) {
    $scope.showLoader = true;
    $http.get('getWorkSamples.php').then(function(d) {
        $scope.list = d.data;
    }, function(error) {

        alert('failed to load users list');

    });

});