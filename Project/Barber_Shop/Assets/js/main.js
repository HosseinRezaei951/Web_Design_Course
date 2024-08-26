var app = angular.module('MainApp', []);

app.controller('WorkSamplesController', function($scope, $http) {
    $scope.showLoader = true;
    $http.get('getWorkSamples.php').then(function(d) {
        $scope.list = d.data;
    }, function(error) {

        alert('failed to load users list');

    });

});

app.controller('ModelsController', function($scope, $http) {
    $scope.showLoader = true;
    $http.get('getModels.php').then(function(d) {
        $scope.list = d.data;
    }, function(error) {

        alert('failed to load users list');

    });

});

app.controller('SeeReservationController', function($scope, $http) {
    $scope.showLoader = true;
    $http.get('getSeeReservation.php').then(function(d) {
        $scope.list = d.data;
        console.log($scope.list)
    }, function(error) {

        alert('failed to load users list');

    });

});

app.controller('BarberShopInfoController', function($scope, $http) {
    $scope.showLoader = true;
    $http.get('getBarberShopInfo.php').then(function(d) {
        $scope.list = d.data;
    }, function(error) {

        alert('failed to load users list');

    });

});


app.controller('ReservationCustomerController', function($scope, $http) {
    $scope.showLoader = true;
    $http.get('getReservationCustomer.php').then(function(d) {
        $scope.list = d.data;
    }, function(error) {

        alert('failed to load users list');

    });

});