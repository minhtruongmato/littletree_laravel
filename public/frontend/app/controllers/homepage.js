(function(){
    app.controller('HomepageController', function($scope, $http, API_URL, $uibModal, $mdDialog, menuProductFactory, productsFactory, listNewsFactory, listAdvisesFactory, $sce){
        $scope.products = [];
        $scope.discounts = [];
        $scope.menuProduct = [];
        $scope.latestAdvises = [];
        $scope.news = [];
        $scope.$sce = $sce;
        var alert;
        // Fetch all products
        productsFactory.products()
            .then(function(success){
                $scope.products = success.data;
            }, function(error){

            });

        // Fetch discount products
        $http({
            method: 'GET',
            url: API_URL + 'discount_product'
        }).then(function(success){
            $scope.discounts = success.data;
            $http({
                        method: 'GET',
                        url: API_URL + 'get_all_product',
                    }).then(function(response){
                        $scope.addToLikeProduct = function(product_id){
                            $http({
                                method: 'GET',
                                url: API_URL + 'user_like_product',
                                params: {
                                    product_id: product_id
                                }
                            }).then(function(response){
                                for(i = 0; i<$scope.discounts.length ; i++){
                                    if($scope.discounts[i].id == product_id){
                                        if($scope.discounts[i].like == "bỏ yêu thích"){
                                            $scope.discounts[i].like = "lưu yêu thích";
                                        }else{
                                            $scope.discounts[i].like = "bỏ yêu thích";
                                        }
                                        break;
                                    }
                                }
                            }, function(error){
                                console.log(error);
                            });
                        };
                        angular.forEach($scope.discounts, function(value, key){
                            for(i = 0; i<response.data.result.length ; i++){
                              if(value.id == response.data.result[i].product_id && response.data.result[i].user_id == document.getElementById("user_id").innerHTML){
                                 $scope.discounts[key].like = "bỏ yêu thích";
                                 break;
                              }else{
                                 $scope.discounts[key].like = "lưu yêu thích";
                              }
                            }
                        });     
                    }, function(error){
                        
                    });
        }, function(error){

        });

        // Fetch introduce
        $http({
            method: 'GET',
            url: API_URL + 'introduce'
        }).then(function(success){
            $scope.introduce = success.data;
        }, function(error){

        });

        // Build menu product
        menuProductFactory.menuProduct()
        .then(function(success){
            $scope.menuProduct = success.data;
        }, function(error){

        });

        $http({
            method: 'GET',
            url: API_URL + 'latest_advises'
        }).then(function(success){
            $scope.latestAdvises = success.data;
        }, function(error){

        });

        $scope.open = function(item){
            $scope.selected = item;
            $uibModal.open({
                animation: true,
                templateUrl: 'san-pham/detail-product-modal',
                controller: 'ModalController',
                resolve: {
                    items: function(){
                        return $scope.selected;
                    }
                },
                size: 'lg'
            }).result.then(function(){}, function(res){});
        };

        // Fetch news
        listNewsFactory.news()
        .then(function (success) {
            $scope.news = success.data;
        }, function (error) {

        });

        // Fetch news
        listAdvisesFactory.advises()
        .then(function (success) {
            $scope.advises = success.data;
        }, function (error) {

        });

    });
})();