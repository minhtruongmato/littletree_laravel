(function(){
    app.controller('IntroduceController', function($scope, $http, $location, API_URL, $sce){
        $scope.$sce = $sce;
        $scope.introduce = [];

        $http({
            method: 'GET',
            url: API_URL + 'introduce'
        }).then(function(success){
            $scope.introduce = success.data;
            // console.log($scope.introduce);
        }, function(error){

        });
    });
})();