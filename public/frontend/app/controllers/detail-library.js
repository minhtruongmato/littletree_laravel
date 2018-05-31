(function(){
    app.controller('DetailLibraryController', function($scope, $http, $location, API_URL, $sce){
        $scope.$sce = $sce;
        $urlSplit = $location.path().split("/");
        var slug = $urlSplit[3];
            $scope.slug = slug;

        $http({
            method: 'GET',
            url: API_URL + 'library_detail',
            params: {
                slug: slug,
            }
        }).then(function(success){
            $scope.detail = success.data;
        }, function(error){

        });
    });
})();