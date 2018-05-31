<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function(){
    Route::resource('product', 'ProductController');
});

Route::prefix('v1')->group(function() {
    Route::group(array('namespace' => 'Api'), function() {
        /**
         * Introduce API
         */
        Route::resource('introduce', 'IntroduceApiController');
        Route::get('introduce', 'IntroduceApiController@fetchAllIntroduce')->name('introduce.fetchAllIntroduce');

        /**
         * Library API
         */
        Route::resource('library', 'LibraryApiController');
        Route::get('library', 'LibraryApiController@fetchAllLibrary')->name('library.fetchAllLibrary');
        Route::get('library_detail', 'LibraryApiController@detail')->name('library.detail');

        /**
         * Product API
         */
        Route::resource('product', 'ProductApiController');
        Route::get('product', 'ProductApiController@index')->name('product.index');
        Route::get('products', 'ProductApiController@fetchAllProduct')->name('product.fetchAllProduct');
        Route::get('discount_product', 'ProductApiController@fetchDiscountProduct')->name('product.fetchDiscountProduct');
        Route::get('menu_product', 'ProductApiController@fetchMenuProduct')->name('product.fetchMenuProduct');
        Route::get('target_products', 'ProductApiController@fetchTargetProducts')->name('product.fetchTargetProducts');
        Route::get('detail_product', 'ProductApiController@detail')->name('product.detail');
        Route::get('search', 'ProductApiController@search')->name('product.search');
        Route::get('target_search', 'ProductApiController@targetSearch')->name('product.targetSearch');
        Route::get('relate_products', 'ProductApiController@fetchTrademarkProduct')->name('product.fetchTrademarkProduct');

        /**
         * Blog API
         */
        Route::resource('blog', 'BlogApiController');
        Route::get('advises', 'BlogApiController@fetchAllAdvises')->name('blog.fetchAllAdvises');
        Route::get('latest_advises', 'BlogApiController@fetchLatestAdvises')->name('blog.fetchLatestAdvises');
        Route::get('news', 'BlogApiController@fetchAllNews')->name('blog.fetchAllNews');
        Route::get('latest_news', 'BlogApiController@fetchLatestNews')->name('blog.fetchLatestNews');
        Route::get('category', 'BlogApiController@fetchCategoryByType')->name('blog.fetchCategoryByType');
        Route::get('blog_category', 'BlogApiController@fetchBlogByCategory')->name('blog.fetchCafetchBlogByCategorytegoryByType');
        Route::get('detail', 'BlogApiController@detail')->name('blog.detail');

        /**
         * Comment API
         */
        Route::resource('comment', 'CommentApiController');
        Route::get('add_blog_comment', 'CommentApiController@addCommentBlog')->name('comment.addCommentBlog');
        Route::get('get_blog_comment', 'CommentApiController@getBlogComment')->name('comment.getBlogComment');
        Route::get('add_product_comment', 'CommentApiController@addProductComment')->name('comment.addProductComment');
        Route::get('get_product_comment', 'CommentApiController@getProductComment')->name('comment.getProductComment');
        /**
         * Cart API
         */
        Route::resource('cart', 'CartApiController');
        Route::get('check_product_exist', 'CartApiController@checkProductExist')->name('cart.checkProductExist');
        Route::get('get_stored_cart_products', 'CartApiController@getStoredCartProducts')->name('cart.getStoredCartProducts');
        Route::get('checkout', 'CartApiController@checkout')->name('cart.checkout');
        Route::get('auto_fill_personal_info', 'CartApiController@fetchLoggedInfo')->name('cart.fetchLoggedInfo');


        /**
         * Like product API
         */
        Route::resource('like', 'UserLikeProductApiController');
        Route::get('user_like_product', 'UserLikeProductApiController@store')->name('like.store');
        Route::get('get_all_product', 'UserLikeProductApiController@getAll')->name('like.getAll');
        Route::get('show_like_product', 'UserLikeProductApiController@getAllLike')->name('like.getAllLike');

        /**
         * Tasting API
         */
        Route::resource('tasting', 'TastingApiController');
        Route::get('check_tasting_exist', 'TastingApiController@checkTastingExist')->name('tasting.check_tasting_exist');
        Route::get('checkout_tasting', 'TastingApiController@checkout')->name('tasting.checkout_tasting');

        /**
         * Customer API
         */
        Route::resource('customer', 'CustomerApiController');
        Route::get('customer_info', 'CustomerApiController@fetchCustomerInfo')->name('customer.fetchCustomerInfo');
        Route::get('customer_favorite_product', 'CustomerApiController@fetchCustomerFavoriteProduct')->name('customer.fetchCustomerFavoriteProduct');
        Route::get('customer_not_complete', 'CustomerApiController@fetchNotCompleteOrder')->name('customer.fetchNotCompleteOrder');
        Route::get('customer_complete', 'CustomerApiController@fetchCompleteOrder')->name('customer.fetchCompleteOrder');
        Route::get('update_info', 'CustomerApiController@updateInfo')->name('customer.updateInfo');

        //origin routes
        Route::resource('origin', 'OriginApiController');
        Route::get('origin', 'OriginApiController@index')->name('origin.index');

        //subscrie routes
        Route::resource('subscrie', 'SubscribeApiController');
        Route::get('subscrie', 'SubscribeApiController@save')->name('subscrie.save');

        //contact routes
        Route::resource('contact', 'ContactApiController');
        Route::get('sendmail', 'ContactApiController@sendMail')->name('subscrie.contact');

        //contact routes
        Route::resource('quotation', 'QuotationApiController');
        Route::get('sendMailQuotation', 'QuotationApiController@sendMail');

        //search routes
        Route::get('searchAllBlog', 'SearchApiController@searchAllBlog');
        Route::get('searchAllProduct', 'SearchApiController@searchAllProduct');
    });
});