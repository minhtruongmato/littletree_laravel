(function(){
	app.controller('SubscribeController', function($scope, $http, API_URL, $location, $sce){
		$scope.$sce = $sce;
		$scope.send = function(user) {
            $http({
	            method: 'GET',
	            url: API_URL + 'subscrie',
	            params: {
	                email: user.email
	            }
	        }).then(function(success){
	            if(success.data.message == 'success'){
	            	alert('Đăng ký thành công!');
	            	$('#subs_email').val('');
	            }else{
	            	alert('Đăng ký thất bại. Email này đã tồn tại!');
	            }
	        }, function(error){

	        });
        };
		

	});
})();