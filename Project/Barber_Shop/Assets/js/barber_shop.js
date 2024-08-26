var app = angular.module('BarberShopInfoApp', []);

app.controller('BarberShopInfoController', function($scope, $http) {
    $scope.showLoader = true;
    $http.get('getBarberShopInfo.php').then(function(d) {
        $scope.list = d.data;
    }, function(error) {

        alert('failed to load users list');

    });

});