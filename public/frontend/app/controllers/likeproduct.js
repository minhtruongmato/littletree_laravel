// (function(){
//     app.controller('UserLikeProduct', function($scope, $http,API_URL){
//         console.log($scope.product_id);
//         $scope.addToLikeProduct = function(product_id){
//             $http({
//                 method: 'GET',
//                 url: API_URL + 'user_like_product',
//                 params: {
//                     product_id: product_id
//                 }
//             }).then(function(response){
//                 $scope.like = 1;
//                 console.log(response);
//             }, function(error){
//                 console.log(error);
//             });
//         };
//     });
// })();