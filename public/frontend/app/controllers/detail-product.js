(function(){
    app.controller('DetailProductController', function($scope, $http, API_URL, $uibModal, $location, $sce, menuProductFactory){
        $scope.$sce = $sce;
        $scope.menuProduct = [];
        $scope.detail = [];
        $scope.targetProducts = [];
        var page = 1;
        $urlSplit = $location.path().split("/");

        //rating
        $scope.count = 0;
        $scope.rating = 5;
        $scope.secondRate = 0;
        $scope.readOnly = true;
        $scope.onItemRating = function(rating){
          alert('On Rating: ' + rating);
        };



        // Build menu product
        menuProductFactory.menuProduct()
            .then(function(success){
                $scope.menuProduct = success.data;
            }, function(error){

            });

        // Fetch product information
        $http({
            method: 'GET',
            url: API_URL + 'detail_product',
            params: {
                slug: $urlSplit[4]
            }
        }).then(
            function(success){
                $scope.detail = success.data[0];
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
                                if($scope.detail.like == "Bỏ yêu thích"){
                                    $scope.detail.like = "Lưu yêu thích";
                                }else{
                                    $scope.detail.like = "Bỏ yêu thích";
                                }
                        }, function(error){
                            console.log(error);
                        });
                    };
                    for(i = 0; i<response.data.result.length ; i++){
                      if($scope.detail.id == response.data.result[i].product_id && response.data.result[i].user_id == document.getElementById("user_id").innerHTML){
                         $scope.detail.like = "Bỏ yêu thích";
                         break;
                      }else{
                         $scope.detail.like = "Lưu yêu thích";
                      }
                    }    
                }, function(error){
                    
                });
                product_id = $scope.detail.id;
                trademark_id = $scope.detail.trademark_id;

                if(trademark_id != null){
                    $http({
                        method: 'GET',
                        url: API_URL + 'relate_products',
                        params: {
                            id: product_id,
                            trademark_id: trademark_id
                        }
                    }).then(
                        function(success){
                            $scope.productTrademarks = success.data;
                            $http({
                                method: 'GET',
                                url: API_URL + 'get_all_product',
                            }).then(function(response){
                                $scope.addToLikeProduct1 = function(product_id){
                                    $http({
                                        method: 'GET',
                                        url: API_URL + 'user_like_product',
                                        params: {
                                            product_id: product_id
                                        }
                                    }).then(function(response){
                                        for(i = 0; i<$scope.productTrademarks.length ; i++){
                                            if($scope.productTrademarks[i].id == product_id){
                                                if($scope.productTrademarks[i].like == "Bỏ yêu thích"){
                                                    $scope.productTrademarks[i].like = "Lưu yêu thích";
                                                }else{
                                                    $scope.productTrademarks[i].like = "Bỏ yêu thích";
                                                }
                                                break;
                                            }
                                        }
                                    }, function(error){
                                        console.log(error);
                                    });
                                };
                                angular.forEach($scope.productTrademarks, function(value, key){
                                    for(i = 0; i<response.data.result.length ; i++){
                                      if(value.id == response.data.result[i].product_id && response.data.result[i].user_id == document.getElementById("user_id").innerHTML){
                                         $scope.productTrademarks[key].like = "Bỏ yêu thích";
                                         break;
                                      }else{
                                         $scope.productTrademarks[key].like = "Lưu yêu thích";
                                      }
                                    }
                                });     
                            }, function(error){
                                
                            });
                        }, function(error){

                    });
                }else{
                    $scope.productTrademarks = null;
                }
                

                $http({
                    method: 'GET',
                    url: API_URL + 'target_products',
                    params: {
                        target: 'thuong-hieu',
                        subTarget: $scope.detail.trademark_slug
                    }
                }).then(
                    function(success){
                        $scope.targetProducts = success.data.targetProducts;
                    }, function(error){

                });

                $http({
                    method: 'GET',
                    url: API_URL + 'get_product_comment',
                    params: {
                        id: product_id
                    }
                }).then(
                    function(res){
                        $scope.productComments = res.data.result.data;
                        var check_page = res.data.total;
                        $scope.secondRate = res.data.averageRating;
                        $scope.count = res.data.count;
                        if(page >= check_page || count == 0){
                            $('.see-more').hide();
                        }
                    }, function(error){

                });
            }, function(error){

        });

        $scope.open = function(item){
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


        /**
         * comment blog
         */
        
        $scope.save = function(id){
            var url = 'http://localhost/hamruouthinh24/';
            $("#sendComment").prop('disabled', true);
            $http({
                method: 'GET',
                url: API_URL + 'add_product_comment',
                params: {
                    product_id: id,
                    author: $scope.author,
                    email: $scope.email,
                    rating: $scope.rating,
                    content: $scope.content
                }
            }).then(function(success){

                // $("#sendComment").prop('disabled', false);
                $('#inputMessage').val('');
                $scope.comment = success.data;
                // var bindComment = '<div class="media first-comment" ng-repeat="comments in blogComments">';
                // bindComment += '<div class="media-left">';
                // bindComment += '<img class="media-object" src="'+url+'public/frontend/img/users_ava.png" alt="users_ava">';
                // bindComment += '</div>';
                // bindComment += '<div class="media-body">';
                // bindComment += '<h4 class="media-heading">'+$scope.author+'</h4>';
                // bindComment += '<p>'+$scope.content+'</p>';
                // bindComment += '</div>';
                // bindComment += '</div>';
                // if($('.first-comment:first-child').length != 0){
                //     $('.first-comment:first-child').before(bindComment);
                // }else{
                //     $(bindComment).appendTo('.list-comment');
                // }
                location.reload();
            }, function(error){

            });
        };

        $scope.seeMore =function(id){
            page++;
            var url = 'http://localhost/hamruouthinh24/';
            $http({
                method: 'GET',
                url: API_URL + 'get_product_comment',
                params: {
                    id: id,
                    page: page
                }
            }).then(function(success){
                var comment =success.data.result.data;
                var check_page = success.data.total;
                if(page >= check_page){
                    $('.see-more').hide();
                }
                // console.log(success.data.total);
                $.each(comment, function (index, value) {
                    var bindComment = '<div class="media first-comment" ng-repeat="comments in blogComments">';
                    bindComment += '<div class="media-left">';
                    bindComment += '<img class="media-object" src="'+url+'public/frontend/img/users_ava.png" alt="users_ava">';
                    bindComment += '</div>';
                    bindComment += '<div class="media-body">';
                    bindComment += '<h4 class="media-heading">'+value.author+'</h4>';
                    bindComment += '<p>'+value.content+'</p>';
                    bindComment += '</div>';
                    bindComment += '</div>';
                    $(bindComment).appendTo('.list-comment');
                });
            }, function(error){

            });
        }

        

    });
})();