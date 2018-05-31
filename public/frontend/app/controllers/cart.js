(function(){
    app.controller('CartController', function($rootScope, $scope, $http, $location, $uibModal, $timeout, $window, API_URL, $cookieStore){
        // if($rootScope.countAddedProducts == 0){
        //     window.location = '/hamruouthinh24';
        // }
        $scope.fetchedProducts = (Cookies.get('cartProducts').length > 0) ? JSON.parse(Cookies.get('cartProducts')) : [];
        $scope.storedProducts = Cookies.get('cartProducts');
        $rootScope.countAddedProducts = JSON.parse(Cookies.get('cartProducts')).length;
        $scope.totalPrice = 0;
        $scope.inputQuantity = 1;
        $scope.customerInfo = [];
        $scope.customerId = 0;
        $scope.hideButton = false;
        $scope.orderCode = '';
        $scope.calculatePrice = function(inputQuantity, index){
            var target = angular.copy($scope.fetchedProducts[index]);

            $scope.fetchedProducts[index].totalCost = target.cost * inputQuantity;
            $scope.fetchedProducts[index].quantity = inputQuantity;

            Cookies.set('cartProducts', $scope.fetchedProducts);
        };

        var storedProduct = $scope.storedProducts;
        $scope.removeFromCart = function(index){
            storedProduct = (storedProduct.length > 0) ? JSON.parse(storedProduct) : [];
            storedProduct.splice(index, 1);

            $scope.fetchedProducts = storedProduct;
            $rootScope.countAddedProducts = storedProduct.length;
            // Cookies.remove('storedProduct', { path: '/' });
            Cookies.set('cartProducts', storedProduct, { expires: 1, path: '/' });
            storedProduct = JSON.stringify(storedProduct);
        };

        // Check user logged in or not
        // Default loginCart radio button
        $scope.checkLogin = {
            check: 'loginCart'
        };
        $scope.disabled = false;
        $scope.toStepTwo = 'loginCart';
        $scope.changeLoginCart = function(){
            if($scope.checkLogin.check == 'guestCart'){
                $scope.disabled = true;
            }else{
                $scope.disabled = false;
            }
            $scope.toStepTwo = angular.copy($scope.checkLogin.check);
        };

        // If logged in, user can use registered information to fill in personal form
        $scope.getLoggedInfo = function(){
            $http({
                method: 'GET',
                url: API_URL + 'auto_fill_personal_info'
            }).then(function(response){
                $scope.customerInfo = response.data.output;
            }, function(error){

            });
        };

        // Get personal informations
        $scope.submitForm = function(){
            $scope.submitted = true;
            $scope.customerInfo.id = $('input[name="hidden"]').val();

            $cookieStore.put('personalInfo', $scope.customerInfo);
            window.location = '/hamruouthinh24' + '/xac-nhan-don-hang';
        };
        $scope.customerInfo = $cookieStore.get('personalInfo');

        $scope.getTotalOrderCost = function(){
            var total = 0;
            for(var i = 0; i < $scope.fetchedProducts.length; i++){
                var product = $scope.fetchedProducts[i];
                total += parseInt(product.totalCost);
            }
            return total;
        }

        // Send order to server
        var tempOrderProducts = {
            'products': $scope.fetchedProducts
        };
        $scope.checkout= function(){
            $scope.hideButton = true;
            $http({
                method: 'GET',
                url: API_URL + 'checkout',
                params: {
                    personalInfo: $scope.customerInfo,
                    orderInfo: tempOrderProducts
                }
            }).then(function(response){
                $scope.successMessage1 = "Đơn hàng đã được gửi, chúng tôi sẽ xác nhận trong thời gian sớm nhất!";
                $scope.successMessage2 = "Mã đơn hàng là: ";
                $scope.successMessage3 = "Quý khách đã chọn sử dụng hình thức thanh toán chuyển khoản, nội dung chuyển khoản là: ";

                $scope.showMessage = false;
                if(response.data.message == 'success'){
                    Cookies.remove('cartProducts', {path: '/'});
                    Cookies.remove('cartProducts', {path: '/hamruouthinh24'});
                    $cookieStore.remove('personalInfo');
                    $scope.orderCode = response.data.orderCode
                    $scope.hideButton = true;
                    $scope.showMessage = true;
                }
            }, function(error){

            });
        }
    });
})();