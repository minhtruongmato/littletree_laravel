(function(){
    app.controller('LibraryController', function($scope, $http, $location, API_URL, $sce){
        $scope.$sce = $sce;
        $scope.introduce = [];

        $http({
            method: 'GET',
            url: API_URL + 'library'
        }).then(function(success){
            $scope.library = success.data;
        }, function(error){

        });
    });
})();