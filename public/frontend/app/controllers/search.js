(function(){
    app.controller('SearchController', function($scope, $http, $location, API_URL, $sce){
    	var name = $location.search();
        $http({
            method: 'GET',
            url: API_URL + 'searchAllBlog',
            params: {
                name: name
            }
        }).then(function(success){
            $scope.searchBlog = success.data;
            console.log($scope.searchBlog);
        }, function(error){

        });

        $http({
            method: 'GET',
            url: API_URL + 'searchAllProduct',
            params: {
                name: name
            }
        }).then(function(success){
            $scope.searchProduct = success.data;
            console.log($scope.searchProduct);
        }, function(error){

        });
    });
})();