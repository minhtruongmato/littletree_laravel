(function(){
	app.controller('ContactController', function($scope, $http, API_URL, $location, $sce){
		$scope.$sce = $sce;
        $('.btn-contact').click(function(){
            $('.btn-contact').prop('disabled', true);
        });
		$scope.send = function(contact) {
            $("#before-send").show();
            $http({
                method: 'GET',
                url: API_URL + 'sendmail',
                params: {
                    name : contact.name, email: contact.email, phone : contact.phone, reason : contact.reason, content : contact.content
                }
            }).then(function(success){
                alert('Đăng ký thành công!');
                $("#before-send").hide();
                $('.btn-contact').prop('disabled', false);
            }, function(error){

            });
        };
	});
})();