(function(){
    app.controller('ProductController', function($scope, $http, $uibModal, API_URL, $location, menuProductFactory, productsFactory){
        $scope.coverImage = '';
        $scope.menuProduct = [];
        $scope.products = [];
        $scope.targetProducts = [];
        $scope.currentTarget = '';
        $scope.currentSubTarget = '';

        $urlSplit = $location.path().split("/");
        if($urlSplit.length >= 4){
            $scope.currentTarget = $urlSplit[2];
            $scope.currentSubTarget = $urlSplit[3];
        }

        // Build menu product
        menuProductFactory.menuProduct()
            .then(function(success){
                $scope.menuProduct = success.data;
            }, function(error){

            });

        // Fetch all products
        if($urlSplit[2] == 'san-pham') {      
            productsFactory.products()
                .then(function (success) {
                    $scope.products = success.data;
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
                                for(i = 0; i<$scope.products.length ; i++){
                                    if($scope.products[i].id == product_id){
                                        if($scope.products[i].like == "bỏ yêu thích"){
                                            $scope.products[i].like = "lưu yêu thích";
                                        }else{
                                            $scope.products[i].like = "bỏ yêu thích";
                                        }
                                        break;
                                    }
                                }
                            }, function(error){
                                console.log(error);
                            });
                        };
                        angular.forEach($scope.products, function(value, key){
                            for(i = 0; i<response.data.result.length ; i++){
                              if(value.id == response.data.result[i].product_id && response.data.result[i].user_id == document.getElementById("user_id").innerHTML){
                                 $scope.products[key].like = "bỏ yêu thích";
                                 break;
                              }else{
                                 $scope.products[key].like = "lưu yêu thích";
                              }
                            }
                        });     
                    }, function(error){
                        
                    });
                }, function (error) {

                });
        }

        // Fetch products of target trademark
        if($urlSplit[2] != 'san-pham'){
            $http({
                method: 'GET',
                url: API_URL + 'target_products',
                params: {
                    target: $scope.currentTarget,
                    subTarget: $scope.currentSubTarget
                }
            }).then(
                function(success){
                    $scope.coverImage = success.data.target[0].image;
                    $scope.targetProducts = success.data.targetProducts;
                    $scope.currentTarget = success.data.type;
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
                                for(i = 0; i<$scope.targetProducts.length ; i++){
                                    if($scope.targetProducts[i].id == product_id){
                                        if($scope.targetProducts[i].like == "bỏ yêu thích"){
                                            $scope.targetProducts[i].like = "lưu yêu thích";
                                        }else{
                                            $scope.targetProducts[i].like = "bỏ yêu thích";
                                        }
                                        break;
                                    }
                                }
                            }, function(error){
                                console.log(error);
                            });
                        };
                        angular.forEach($scope.targetProducts, function(value, key){
                            for(i = 0; i<response.data.result.length ; i++){
                              if(value.id == response.data.result[i].product_id && response.data.result[i].user_id == document.getElementById("user_id").innerHTML){
                                 $scope.targetProducts[key].like = "bỏ yêu thích";
                                 break;
                              }else{
                                 $scope.targetProducts[key].like = "lưu yêu thích";
                              }
                            }
                        });     
                    }, function(error){
                        
                    });
            }, function(error){

            });
        };

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

        $scope.openTarget = function(item){
            $scope.selected = item;
            $uibModal.open({
                animation: true,
                templateUrl: '/hamruouthinh24/san-pham/detail-product-modal',
                controller: 'ModalController',
                resolve: {
                    items: function(){
                        return $scope.selected;
                    }
                },
                size: 'lg'
            }).result.then(function(){}, function(res){});
        };

        $scope.search = function(){
            $http({
                method: 'GET',
                url: API_URL + 'search',
                params: {
                    name: $scope.name,
                    price: $scope.price,
                    origin: $scope.origin
                }
            }).then(function(success){
                $scope.products = success.data;
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
                            for(i = 0; i<$scope.products.length ; i++){
                                if($scope.products[i].id == product_id){
                                    if($scope.products[i].like == "bỏ yêu thích"){
                                        $scope.products[i].like = "lưu yêu thích";
                                    }else{
                                        $scope.products[i].like = "bỏ yêu thích";
                                    }
                                    break;
                                }
                            }
                        }, function(error){
                            console.log(error);
                        });
                    };
                    angular.forEach($scope.products, function(value, key){
                        for(i = 0; i<response.data.result.length ; i++){
                          if(value.id == response.data.result[i].product_id && response.data.result[i].user_id == document.getElementById("user_id").innerHTML){
                             $scope.products[key].like = "bỏ yêu thích";
                             break;
                          }else{
                             $scope.products[key].like = "lưu yêu thích";
                          }
                        }
                    });     
                }, function(error){
                    
                });
            }, function(error){

            });
        };
        $scope.searchTarget = function(){
            $http({
                method: 'GET',
                url: API_URL + 'search',
                params: {
                    name: $scope.name,
                    price: $scope.price,
                    target: $scope.currentTarget,
                    subTarget: $scope.currentSubTarget,
                    origin: $scope.origin
                }
            }).then(function(success){
                $scope.targetProducts = success.data;
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
                            for(i = 0; i<$scope.targetProducts.length ; i++){
                                if($scope.targetProducts[i].id == product_id){
                                    if($scope.targetProducts[i].like == "bỏ yêu thích"){
                                        $scope.targetProducts[i].like = "lưu yêu thích";
                                    }else{
                                        $scope.targetProducts[i].like = "bỏ yêu thích";
                                    }
                                    break;
                                }
                            }
                        }, function(error){
                            console.log(error);
                        });
                    };
                    angular.forEach($scope.targetProducts, function(value, key){
                        for(i = 0; i<response.data.result.length ; i++){
                          if(value.id == response.data.result[i].product_id && response.data.result[i].user_id == document.getElementById("user_id").innerHTML){
                             $scope.targetProducts[key].like = "bỏ yêu thích";
                             break;
                          }else{
                             $scope.targetProducts[key].like = "lưu yêu thích";
                          }
                        }
                    });     
                }, function(error){
                    
                });
            }, function(error){

            });
        };

        $http({
            method: 'GET',
            url: API_URL + 'origin'
        }).then(function(success){
            $scope.origins = success.data;
        }, function(error){

        });
    });
})();