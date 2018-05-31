(function(){
	app.controller('QuotationController', function($scope, $http, API_URL, $location, $sce){
		$scope.$sce = $sce;
        $('.btn-quotation').click(function(){
            $('.btn-quotation').prop('disabled', true);
        });
		$scope.send = function(quotation) {
            $("#before-send").show();
            $http({
                method: 'GET',
                url: API_URL + 'sendMailQuotation',
                params: {
                    name : quotation.name, email: quotation.email, phone : quotation.phone, content : quotation.content
                }
            }).then(function(success){
                $("#before-send").hide();
                alert('Đăng ký thành công!');
                $('.btn-quotation').prop('disabled', false);
            }, function(error){

            });
        };
	});
})();