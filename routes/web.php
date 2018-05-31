<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('homepage');
});
Route::get('/', 'HomepageController@index')->name('homepage.index');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

/**
 * Frontend customer page
 */
Route::get('/thong-tin-ca-nhan', function () {
    return view('personal-info');
});

/**
 * Introduce routes
 */
Route::get('/gioi-thieu', function () {
    return view('introduce');
});

/**
 * Lirary routes
 */
Route::get('/thu-vien-anh', function () {
    return view('list-library');
});

Route::get('/thu-vien-anh/{detail}', function () {
    return view('detail-library');
});

/**
 * Frontend product routes
 */
Route::get('/san-pham', function () {
    return view('list-products');
});

Route::get('/san-pham/chi-tiet/{detail}', function () {
    return view('detail-product');
});

Route::get('/thuong-hieu/{target}', function () {
    return view('list-target-products');
});

Route::get('/loai-san-pham/{target}', function () {
    return view('list-target-products');
});

Route::get('/dong-san-pham/{target}', function () {
    return view('list-target-products');
});

Route::get('san-pham/detail-product-modal', function() {
    return view('layouts.detail-product-modal');
});

Route::get('thong-tin-ca-nhan/personal-info-modal', function() {
    return view('layouts.personal-info-modal');
});

Route::get('don-hang/products-in-order-modal', function() {
    return view('layouts.products-in-order-modal');
});

Route::get('product-like/user-like-product-modal', function() {
    return view('layouts.user-like-product-modal');
});

/**
 * Frontend cart routes
 */
Route::get('xem-gio-hang', function(){
    return view('show-cart');
});

Route::get('thu-ruou', function(){
    return view('show-tasting');
});


Route::get('xac-nhan-thong-tin-ca-nhan', function(){
    return view('cart-personal-information');
});

Route::get('xac-nhan-thong-tin-thu-ruou', function(){
    return view('tasting-personal-information');
});

Route::get('xac-nhan-don-hang', function(){
    return view('cart-confirm-order');
});

Route::get('xac-nhan-thu-ruou', function(){
    return view('tasting-confirm-order');
});

/**
 * Frontend blog routes
 */
Route::get('/tu-van', function () {
    return view('list-advises');
});

Route::get('/tu-van/danh-muc/{slug}', function () {
    return view('list-advises');
});

Route::get('/tin-tuc', function () {
    return view('list-news');
});

Route::get('/tin-tuc/danh-muc/{slug}', function () {
    return view('list-news');
});

Route::get('/tu-van/{target}', function () {
    return view('detail-blog');
});

Route::get('/tin-tuc/{target}', function () {
    return view('detail-blog');
});

/**
 * Frontend contact route
 */
Route::get('/lien-he', function () {
    return view('contact');
});

/**
 * Search route
 */
Route::get('tim-kiem', function () {
    return view('search');
});

/**
 * 404 route
 */
Route::get('404', function () {
    return view('404');
});

/**
 * Terms route
 */
Route::get('dieu-khoan', function () {
    return view('terms');
});

Auth::routes();

//Route::get('/home', 'HomeController@index');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    // Password reset routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

    // Admin routes
    Route::group(array('namespace' => 'Admin'), function() {
        // Introduce routes
        Route::get('introduce/aboutUs', 'IntroduceController@aboutUs');
        Route::get('introduce/{type}', 'IntroduceController@introduce');
        Route::post('introduce/saveIntroduce/{slug}', 'IntroduceController@saveIntroduce')->name('introduce.saveIntroduce');



        //image library
        Route::resource('library', 'LibraryController');
        // Route::post('library/store', 'LibraryController@store')->name('library.store');
        Route::post('library/update/{id}', 'LibraryController@update')->name('library.update');

        // list image
        Route::resource('image', 'ImageController');
        Route::post('image/store/{id}', 'ImageController@store')->name('image.store');

        //Type routes
        Route::resource('type', 'TypeController');
        Route::post('type/search', 'TypeController@search')->name('type.search');
        Route::post('type/update/{id}', 'TypeController@update')->name('type.update');

        //Kind routes
        Route::resource('kind', 'KindController');
        Route::post('kind/search', 'KindController@search')->name('kind.search');
        Route::post('kind/update/{id}', 'KindController@update')->name('kind.update');
        
        // Product routes
        Route::resource('product', 'ProductController');
        Route::post('product/search', 'ProductController@search')->name('product.search');
        Route::post('product/store', 'ProductController@store')->name('product.store');
        Route::post('product/update/{id}', 'ProductController@update')->name('product.update');
        Route::get('product/fetchByType/{type_id}', 'ProductController@fetchByType');
        Route::get('product/fetchByKind/{kind_id}', 'ProductController@fetchByKind');
        Route::get('product/fetchByTrademark/{trademark_id}', 'ProductController@fetchByTrademark');
        Route::post('product/deleteImage', 'ProductController@delete_image');

        // Order routes
//        Route::resource('order', 'OrderController');
        Route::post('order/search', 'OrderController@search')->name('order.search');
        Route::get('order/{status}', 'OrderController@listing');
        Route::get('order/approve/{id}', 'OrderController@approve')->name('order.approve');
        Route::get('order/complete/{id}', 'OrderController@complete')->name('order.complete');
        Route::get('order/cancel/{id}', 'OrderController@cancel')->name('order.cancel');
        Route::get('order/rollback/{id}', 'OrderController@rollback')->name('order.rollback');
        Route::get('export-pending', 'OrderController@excelPending')->name('export.pending');

        // Product Trademark routes
        Route::resource('trademark', 'TrademarkController');
        Route::post('trademark/search', 'TrademarkController@search')->name('trademark.search');
        Route::post('trademark/store', 'TrademarkController@store')->name('trademark.store');
        Route::post('trademark/update/{id}', 'TrademarkController@update')->name('trademark.update');
        Route::get('trademark/kind/{type_id}', 'TrademarkController@selectKind');

        // Product Category routes
        Route::resource('category', 'CategoryController');
        Route::post('category/search', 'CategoryController@search')->name('category.search');
        Route::post('category/store', 'CategoryController@store')->name('category.store');
        Route::post('category/update/{id}', 'CategoryController@update')->name('category.update');
        Route::get('category/fetchByType/{type_id}', 'CategoryController@fetchByType');
        Route::get('category/fetchByKind/{kind_id}', 'CategoryController@fetchByKind');
        Route::get('category/fetchByTrademark/{trademark_id}', 'CategoryController@fetchByTrademark');

        // Blog routes
        Route::resource('blog', 'BlogController');
        Route::get('advise', 'BlogController@advise')->name('blog.advise');
        Route::get('news', 'BlogController@news')->name('blog.news');
        Route::post('blog/search', 'BlogController@search')->name('blog.search');
        Route::post('blog/store', 'BlogController@store')->name('blog.store');
        Route::post('blog/update/{id}', 'BlogController@update')->name('blog.update');

        // Blog Category routes
        Route::resource('blog-category', 'BlogCategoryController');
        Route::post('blog-category/search', 'BlogCategoryController@search')->name('blog-category.search');
        Route::post('blog-category/store', 'BlogCategoryController@store')->name('blog-category.store');

        //Tasting routes
        Route::get('tasting/finish', 'TastingController@finish');
        Route::get('tasting/ajax-finish/{id}', 'TastingController@ajaxFinish');
        Route::resource('tasting', 'TastingController');

        //Origin routes
        Route::resource('origin', 'OriginController');
        Route::post('origin/update/{id}', 'OriginController@update')->name('origin.update');
        
        //Product Comment router
        Route::get('comment/product/{id}', 'CommentController@fetchProductComment')->name('comment.fetchProductComment');
        Route::post('comment_product/delete/{id}/{product_id}', 'CommentController@deleteProductComment')->name('comment.deleteProductComment');
        Route::get('comment/blog/{id}', 'CommentController@fetchBlogComment')->name('comment.fetchBlogComment');
        Route::post('comment_blog/delete/{id}/{blog_id}', 'CommentController@deleteBlogComment')->name('comment.deleteBlogComment');

        //subscrie routes
        Route::resource('subscribe', 'SubscribeController');
        Route::get('subscrie/send/{email}', 'SubscribeController@sendMail')->name('subscrie.sendMail');
        Route::post('subscrie/sendAll', 'SubscribeController@sendAll')->name('subscrie.sendAll');
    });
});