(function(){
    app.controller('CustomerController', function($scope, $http, $location, $uibModal, API_URL){
        $scope.customerInfo = [];
        $scope.notCompleteOrders = [];
        $scope.completeOrders = [];
        $scope.customerId = $('input[name="hidden"]').val();
        $scope.notCompleteOrdersMessage = '';
        $scope.completeOrdersMessage = '';

        $scope.formatDate = function(date){
            var dateOut = new Date(date);
            return dateOut;
        };


        /**
         * Fetch personal info
         */
        $http({
            method: 'GET',
            url: API_URL + 'customer_info',
            params: {
                id: $scope.customerId
            }
        }).then(function(success){
            $scope.customerInfo = success.data[0];
        }, function(error){

        });

        /**
         * Fetch personal's NOT COMPLETE order info
         */
        $http({
            method: 'GET',
            url: API_URL + 'customer_not_complete',
            params: {
                id: $scope.customerId
            }
        }).then(function(success){
            $scope.notCompleteOrders = success.data.result;
            $scope.notCompleteOrdersMessage = success.data.message;
            console.log($scope.notCompleteOrders[0].product_info);
        }, function(error){

        });

        $http({
            method: 'GET',
            url: API_URL + 'show_like_product',
        }).then(function(success){
            $scope.showlikeproduct = success.data.result;
            console.log($scope.showlikeproduct);
        }, function(error){

        });

        /**
         * Fetch personal's COMPLETE order info
         */
        $http({
            method: 'GET',
            url: API_URL + 'customer_complete',
            params: {
                id: $scope.customerId
            }
        }).then(function(success){
            $scope.completeOrders = success.data.result;
            $scope.completeOrdersMessage = success.data.message;
        }, function(error){

        });

        /**
         *
         * @param customerInfo
         */
        $scope.getCustomerInfo = function(customerInfo){
            $uibModal.open({
                animation: true,
                templateUrl: 'thong-tin-ca-nhan/personal-info-modal',
                controller: 'ModalController',
                resolve: {
                    items: function(){
                        return customerInfo;
                    }
                },
                size: 'lg'
            }).result.then(function(){}, function(res){});
        }

        $scope.showOrderProductsInfo = function(products){
            $uibModal.open({
                animation: true,
                templateUrl: 'don-hang/products-in-order-modal',
                controller: 'ModalController',
                resolve: {
                    items: function(){
                        return products;
                    }
                },
                size: 'lg'
            }).result.then(function(){}, function(res){});
        }

        $scope.showProductLike = function(products){
            $uibModal.open({
                animation: true,
                templateUrl: 'product-like/user-like-product-modal',
                controller: 'ModalController',
                resolve: {
                    items: function(){
                        return products;
                    }
                },
                size: 'lg'
            }).result.then(function(){}, function(res){});
        }




    });
})();