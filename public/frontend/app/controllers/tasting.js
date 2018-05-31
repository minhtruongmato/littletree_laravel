
(function(){
    app.controller('TastingController', function($rootScope, $scope, $http, $location, $uibModal, $timeout, $window, API_URL, $cookieStore){
        // if($rootScope.counttastingProducts == 0){
        //     window.location = '/hamruouthinh24';
        // }
        $scope.customerInfo = [];
        $scope.fetchedTasting = (Cookies.get('tastingProducts').length > 0) ? JSON.parse(Cookies.get('tastingProducts')) : [];
        $scope.tasting = Cookies.get('tastingProducts');
        var tasting = $scope.tasting;
        $scope.removeFromTasting = function(index){
            tasting = (tasting.length > 0) ? JSON.parse(tasting) : [];
            tasting.splice(index, 1);

            $scope.fetchedProducts = tasting;
            $rootScope.countAddedProducts = tasting.length;
            // Cookies.remove('tasting', { path: '/' });
            Cookies.set('tastingProducts', tasting, { expires: 1, path: '/' });
            tasting = JSON.stringify(tasting);
            window.location = '/hamruouthinh24' + '/thu-ruou';
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
            window.location = '/hamruouthinh24' + '/xac-nhan-thu-ruou';
        };
        $scope.customerInfo = $cookieStore.get('personalInfo');

        // Send tasting to server
        var tempTastingProducts = {
            'product': $scope.fetchedTasting
        };
        $scope.checkout= function(){
            $scope.hideButton = true;
            $http({
                method: 'GET',
                url: API_URL + 'checkout_tasting',
                params: {
                    personalInfo: $scope.customerInfo,
                    tastingInfo1: tempTastingProducts
                }
            }).then(function(response){
                $scope.successMessage1 = "Đơn thử rượu đã được gửi, chúng tôi sẽ xác nhận trong thời gian sớm nhất!";
                // console.log(response);
                $scope.showMessage = false;
                if(response.data.message == 'success'){
                    Cookies.remove('tastingProducts', {path: '/'});
                    Cookies.remove('tastingProducts', {path: '/hamruouthinh24'});
                    $cookieStore.remove('personalInfo');
                    $scope.tastingCode = response.data.tastingCode
                    $scope.hideButton = true;
                    $scope.showMessage = true;
                }
            }, function(error){

            });
        }
    });
})();