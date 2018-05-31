(function(){
    app.controller('DetailBlogController', function($scope, $http, API_URL, $location, $sce){
        $scope.$sce = $sce;
        $scope.selected = [];
        $scope.news = [];

        var comment;
        var type = '';
        var page = 1;
        $scope.count = 0;
        $urlSplit = $location.path().split("/");
        if(($urlSplit[2] == 'tu-van' || $urlSplit[2] == 'tin-tuc') && $urlSplit.length >= 4){
            var slug = $urlSplit[3];
            $scope.slug = slug;

        }

        if($urlSplit[2] == 'tu-van' || $urlSplit[2] == 'tin-tuc'){
            type = ($urlSplit[2] == 'tu-van') ? 0 : 1;
            title = ($urlSplit[2] == 'tu-van') ? 'tư vấn' : 'tin tức';
            $scope.title = title;
            $scope.type = type;
        }

        $http({
            method: 'GET',
            url: API_URL + 'detail',
            params: {
                slug: slug
            }
        }).then(function(success){
            $scope.selected = success.data[0];
            category_id = $scope.selected.category_id;
            blog_id = $scope.selected.id;
            $http({
                method: 'GET',
                url: API_URL + 'get_blog_comment',
                params: {
                    id: blog_id
                }
            }).then(
                function(res){
                    $scope.blogComments = res.data.result.data;
                    var check_page = res.data.total;
                    $scope.count = res.data.count;
                    if(page >= check_page || count == 0){
                        $('.see-more').hide();
                    }
                }, function(error){

            });

            $http({
                method: 'GET',
                url: API_URL + 'latest_news',
                params: {
                    type: type,
                    category_id : category_id
                }
            }).then(function(success){
                $scope.news = success.data;
            }, function(error){

            });

        }, function(error){

        });

        

        $http({
            method: 'GET',
            url: API_URL + 'latest_advises',
            params: {
                type: type
            }
        }).then(function(success){
            $scope.advises = success.data;
        }, function(error){

        });

        /**
         * Fetch categories for each type
         */
        $http({
            method: 'GET',
            url: API_URL + 'category',
            params: {
                type: type,
            }
        }).then(function(success){
            $scope.categories = success.data;
        }, function(error){

        });

        /**
         * comment blog
         */
        
        $scope.save = function(id){
            var url = 'http://localhost/hamruouthinh24/';
            $("#sendComment").prop('disabled', true);
            $http({
                method: 'GET',
                url: API_URL + 'add_blog_comment',
                params: {
                    blog_id: id,
                    author: $scope.author,
                    email: $scope.email,
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
                // console.log(blog_id);
            }, function(error){

            });
        };

        $scope.seeMore =function(id){
            page++;
            var url = 'http://localhost/hamruouthinh24/';
            $http({
                method: 'GET',
                url: API_URL + 'get_blog_comment',
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
                console.log(success.data.total);
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