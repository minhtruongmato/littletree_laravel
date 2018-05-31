(function(){
    app.controller('MainController', function($rootScope, $scope, $http, API_URL){
        // Cookies.remove('tastingProducts', {path: '/'});
        // 
        $scope.storedProducts = (Cookies.get('cartProducts') != undefined) ? Cookies.get('cartProducts') : [];
        $rootScope.countAddedProducts = 0;
        if(angular.isArray(Cookies.get('cartProducts')) === true){
            $rootScope.countAddedProducts = Cookies.get('cartProducts').length;
        }else{
            if(Cookies.get('cartProducts') != undefined && Cookies.get('cartProducts').length > 0){
                $rootScope.countAddedProducts = JSON.parse(Cookies.get('cartProducts')).length;
            }else{
                $rootScope.countAddedProducts = 0;
            }
        }

        $scope.tastingProducts = (Cookies.get('tastingProducts') != undefined) ? Cookies.get('tastingProducts') : [];
        $rootScope.counttastingProducts = 0;
        if(angular.isArray(Cookies.get('tastingProducts')) === true){
            $rootScope.counttastingProducts = Cookies.get('tastingProducts').length;
        }else{
            if(Cookies.get('tastingProducts') != undefined && Cookies.get('tastingProducts').length > 0){
                $rootScope.counttastingProducts = JSON.parse(Cookies.get('tastingProducts')).length;
            }else{
                $rootScope.counttastingProducts = 0;
            }
        }

        $scope.addToCart = function(id){
            $http({
                method: 'GET',
                url: API_URL + 'check_product_exist',
                params: {
                    id: id
                }
            }).then(function(response){
                var isError = false;
                if(response.data.message === 'out_of_stock'){
                    alert = $mdDialog.alert({
                        title: 'Attention',
                        textContent: 'This is an example of how easy dialogs can be!',
                        ok: 'Close'
                    });
                    $mdDialog
                        .show( alert )
                        .finally(function() {
                            alert = undefined;
                        });
                    isError = true;
                }
                // If product in discount event, get discount price. Get price otherwise
                var cost = response.data.result.is_discount == 1 ? response.data.result.discount_price : response.data.result.price;
                var arrayProduct = {
                    id: response.data.id,
                    name: response.data.result.name,
                    slug: response.data.result.slug,
                    image: response.data.result.image,
                    quantity: 1,
                    cost: cost,
                    totalCost: cost
                };
                var storedProducts = $scope.storedProducts;

                if(!isError){
                    var isExist = false;
                    if(storedProducts.length > 0){
                        storedProducts = JSON.parse(storedProducts);
                        for(var index = 0; index < storedProducts.length; index++){
                            if(storedProducts[index].id == response.data.id){
                                isExist = true;
                            }
                        }
                        if(!isExist){
                            storedProducts.push(arrayProduct);
                        }
                    }else{
                        storedProducts.push(arrayProduct);
                    }

                    Cookies.set('cartProducts', storedProducts, { expires: 1, path: '/' });
                }

                $scope.storedProducts = Cookies.get('cartProducts');
                $rootScope.countAddedProducts = JSON.parse(Cookies.get('cartProducts')).length;
                // console.log(storedProducts);
            }, function(error){

            });
        };
        $scope.addToTasting = function(id){
            $http({
                method: 'GET',
                url: API_URL + 'check_tasting_exist',
                params: {
                    id: id
                }
            }).then(function successCallback(response) {
                var isError = false;
                if(response.data.message === 'out_of_stock'){
                    alert = $mdDialog.alert({
                        title: 'Attention',
                        textContent: 'This is an example of how easy dialogs can be!',
                        ok: 'Close'
                    });
                    $mdDialog
                        .show( alert )
                        .finally(function() {
                            alert = undefined;
                        });
                    isError = true;
                }
                var arrayProduct = {
                    id: response.data.id,
                    name: response.data.result.name,
                    slug: response.data.result.slug,
                    image: response.data.result.image

                };

                var tastingProducts = $scope.tastingProducts;

                if(!isError){
                    var isExist = false;
                    if(tastingProducts.length > 0){
                        tastingProducts = JSON.parse(tastingProducts);
                        for(var index = 0; index < tastingProducts.length; index++){
                            if(tastingProducts[index].id == response.data.id){
                                isExist = true;
                            }
                        }
                        if(!isExist){
                            tastingProducts.push(arrayProduct);
                        }
                    }else{
                        tastingProducts.push(arrayProduct);
                    }

                    Cookies.set('tastingProducts', tastingProducts, { expires: 1, path: '/' });
                }

                $scope.tastingProducts = Cookies.get('tastingProducts');
                $rootScope.counttastingProducts = JSON.parse(Cookies.get('tastingProducts')).length;
                console.log(tastingProducts);
                // if($rootScope.counttastingProducts >= 6){
                //     alert('Không thể thử quá 6 loại rượu');
                // }

                
            }, function errorCallback(arrayProduct) {
                
            });
        }       
        $scope.login = function(){
            alert('Bạn phải đăng nhập');
        };

        
    });
})();