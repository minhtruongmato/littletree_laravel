(function(){
    app.controller('ModalController', ['$scope', '$http', 'API_URL', '$uibModalInstance', 'items', function($scope, $http, API_URL, $uibModalInstance, items){
        $scope.dataModal = items;
        console.log($scope.dataModal);

        $scope.ok = function () {
            $uibModalInstance.close();
        };

        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };
        var customerInfo = $scope.dataModal;
        $scope.submitPesonalForm = function(){
            console.log(customerInfo);
            $http({
                method: 'GET',
                url: API_URL + 'update_info',
                params: {
                    customerInfo: customerInfo
                }
            }).then(function(response){
                console.log(response.data.message);
                window.location = '/hamruouthinh24/thong-tin-ca-nhan';
            }, function(error){

            });
        }
    }]);
})();