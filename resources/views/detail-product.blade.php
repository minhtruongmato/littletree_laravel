@extends('layouts.frontend-template')
@section('content')
    <link href="{{ asset("public/frontend/css/flexslider.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("public/frontend/css/store.css")}}" rel="stylesheet" type="text/css" />
    <section class="main_content" ng-controller="DetailProductController">
        <!-- InstanceBeginEditable name="content" -->
        <div class="container">
            <div class="row">
                <div class="nav_product">
                    <ul class="list-unstyled">
                        <span class="panel-heading">Danh mục sản phẩm</span>
                        <li class="nav_product_hover" ng-repeat="type in menuProduct.type">
                            <a href="{{ url('loai-san-pham') }}/<% type.slug %>"  target="_self"><% type.title %></a>
                            <div class="nav_expand">
                                <div class="left hidden-sm hidden-xs">
                                    <div class="mask">
                                        <img src="{{ asset('storage/app/type') }}/<% type.image %>" alt="image of product category">
                                    </div>
                                </div>
                                <div class="right">
                                    <div class="type" ng-repeat="kind in menuProduct.kind" ng-hide="kind.type_id != type.id">
                                        <label >
                                            <a href="{{ url('dong-san-pham') }}/<% kind.slug %>"  target="_self"><% kind.title %></a>
                                        </label>
                                        <ul class="list-unstyled list-inline">
                                            <li ng-repeat="trademarks in menuProduct.trademarks" ng-hide="trademarks.kind_id != kind.id">
                                                <a href="{{ url('thuong-hieu') }}/<% trademarks.slug %>" target="_self"><% trademarks.name %></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <!--<div class="catelogy col-md-3 col-sm-12 col-xs-12">
                    <div class="panel panel-default">

                        <div class="panel-heading">Danh mục sản phẩm</div>

                        <ul class="list-group">
                            <li class="list-group-item" ng-repeat="type in menuProduct.type">
                                <a href="{{ url('loai-san-pham') }}/<% type.slug %>"  target="_self"><% type.title %></a>
                                <ul class="list-group">
                                    <li class="list-group-item" ng-repeat="kind in menuProduct.kind" ng-hide="kind.type_id != type.id">
                                        <a href="{{ url('dong-san-pham') }}/<% kind.slug %>"  target="_self"><% kind.title %></a>
                                        <ul class="list-group">
                                            <li class="list-group-item" ng-repeat="trademarks in menuProduct.trademarks" ng-hide="trademarks.kind_id != kind.id">
                                                <a href="{{ url('thuong-hieu') }}/<% trademarks.slug %>" target="_self"><% trademarks.name %></a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>-->

                <div class="product_detail container-fluid">
                    <!--<a class="preview" href="{{ asset('storage/app') }}/<% detail.image[0] %>">
                        <img src="{{ asset('storage/app') }}/<% detail.image[0] %>" class="w-100" alt="preview">
                    </a>

                    <div class="preview col-md-5 col-sm-5 col-xs-12" ng-repeat="image in detail.image" ng-hide="$index == 0">
                        <a class="preview" href="{{ asset('storage/app') }}/<% image %>">
                            <img src="{{ asset('storage/app') }}/<% image %>" class="w-100" alt="preview">
                        </a>
                    </div>-->
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div id="slider" class="flexslider">
                                <ul class="slides">

                                    <li ng-repeat="image in detail.image">
                                        <div class="mask">
                                            <img src="{{ asset('storage/app/products/') }}/<% detail.slug %>/<% image %>" class="w-100" alt="preview">
                                        </div>
                                    </li>

                                </ul>
                            </div>
                            <div id="carousel" class="flexslider">
                                <ul class="slides">
                                    <li ng-repeat="image in detail.image">
                                        <div class="mask">
                                            <img src="{{ asset('storage/app/products/') }}/<% detail.slug %>/<% image %>" class="w-100" alt="preview">
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="infomation col-md-6 col-sm-6 col-xs-12">
                            <h2 class="productName"><% detail.name %></h2>

                            <h2 class="productPrice">
                                <span class="price"><% detail.price | currency:VND:0 | commaToDot | removeUSCurrency  %> vnđ</span>
                            </h2>
                            <jk-rating-stars rating="secondRate" read-only="readOnly" ></jk-rating-stars> <strong>Tổng số đánh giá:  <span style="color: blue"> <% count %></span></strong>

                            <div class="info">
                                <table class="table">
                                    <tr>
                                        <td>Nồng độ cồn</td>
                                        <td><% detail.concentrations %></td>
                                    </tr>
                                    <tr>
                                        <td>Dung tích</td>
                                        <td><% detail.capacity %></td>
                                    </tr>
                                    <tr>
                                        <td>Nguyên liệu</td>
                                        <td><% detail.material %></td>
                                    </tr>
                                    <tr>
                                        <td>Niên vụ</td>
                                        <td><% detail.year %></td>
                                    </tr>
                                    <tr>
                                        <td>Nhà sản xuất</td>
                                        <td><% detail.producer %></td>
                                    </tr>
                                    <tr>
                                        <td>Thể tích</td>
                                        <td><% detail.volume %></td>
                                    </tr>
                                    <tr>
                                        <td>Xuất xứ</td>
                                        <td><% detail.origin_title %></td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            <p ng-bind-html="$sce.trustAsHtml(detail.description)"></p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            Chia sẻ qua <a href="javascript:void(0);" class="btn btn-primary" role="button"><i class="fa fa-facebook-f" aria-hidden="true"></i> </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            <button class="btn btn-primary" type="submit"  ng-click="addToCart(detail.id)">Thêm vào giỏ hàng</button>
                                            <a href="javascript:void(0);" class="btn btn-primary" role="button" ng-click="addToTasting(detail.id)">Đăng ký thử ruọu</a>
                                            @if(!Auth::guest())
                                                <a class="btn btn-primary" href="#" role="button" ng-click="addToLikeProduct(detail.id)" ><% detail.like %></a>
                                            @else
                                                <a class="btn btn-primary" href="#" role="button" ng-click="login()" >Lưu yêu thích</a>
                                            @endif
                                        </td>
                                    </tr>

                                </table>

                            </div>
                        </div>
                    </div>

                    <div class="detail_info col-md-12 col-sm-12 col-xs-12">
                        <div>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#detail" aria-controls="detail" role="tab" data-toggle="tab">
                                        Thông tin chi tiết
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#comment" aria-controls="comment" role="tab" data-toggle="tab">
                                        Đánh giá sản phẩm
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="detail">
                                    <article>
                                        <p ng-bind-html="$sce.trustAsHtml(detail.content)"></p>
                                    </article>
                                </div>

                                <div role="tabpanel" class="tab-pane" id="comment">
                                    <form role="form" name="comment" ng-submit="save(detail.id)">
                                        <div role="tabpanel" class="tab-pane">
                                            <div class="form-group">
                                                <label for="inputName">Họ tên</label>
                                                <input type="text" class="form-control" id="inputAuthor" placeholder="VD: Nguyễn Văn An" name="author" ng-model="author" ng-required="true">
                                                <span class="help-block" ng-show="comment.author.$error.required">Họ tên không được trống</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail">Email</label>
                                                <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" ng-model="email" ng-required="true">
                                                <span class="help-block" ng-show="comment.email.$error.required">Email không được trống</span>
                                                <span class="help-block" ng-show="comment.email.$error.email">Định dạng email không đúng</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputRating">Đánh giá của bạn</label>
                                                <div class="rating">
                                                    <jk-rating-stars rating="rating"></jk-rating-stars>
                                                    <input type="hidden" name="rating" ng-value="rating" ng-model="rating">
                                                    {{--<span><i class="fa fa-star-o"></i></span>
                                                    <span><i class="fa fa-star-o"></i></span>
                                                    <span><i class="fa fa-star-o"></i></span>
                                                    <span><i class="fa fa-star-o"></i></span>
                                                    <span><i class="fa fa-star-o"></i></span>--}}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputMessage">Nội dung</label>
                                                <textarea class="form-control" id="inputMessage" placeholder="Viết cho chúng tôi cảm nhận của bạn" rows="4" name="content" ng-model="content"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary" type="submit" id="sendComment" ng-disabled="comment.$invalid">Gửi đánh giá</button>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="comments_posts_list">

                                        <table class="table list-comment">
                                            <div class="media first-comment" ng-repeat="comments in productComments">
                                                <div class="media-left" style="width: 10%">
                                                    <img class="media-object" src="{{ asset('public/frontend/img/users_ava.png') }}" alt="users_ava">
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading"><% comments.author %></h4>
                                                    <p ng-bind-html="$sce.trustAsHtml(comments.content)"></p>
                                                </div>
                                            </div>
                                        </table>
                                    </div>
                                    <div class="btn btn-primary see-more" ng-click="seeMore(detail.id)">Xem thêm ...</div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12" ng-if="productTrademarks">
                        <div class="row">
                            <div class="title_big">
                                <h3>Sản phẩm liên quan</h3>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="carousel carousel-showmanymoveone slide" id="itemslider_1">

                                    <div class="carousel-inner">
                                        <div class="item active" ng-repeat="product in productTrademarks">
                                            <div class="product_view col-xs-12 col-sm-6 col-md-3">
                                                <div class="mask">
                                                    <img src="{{ asset('storage/app/products/') }}/<% product.slug %>/<% product.image[0] %>" class="img-responsive center-block">
                                                </div>

                                                <a href="{{ url('san-pham/chi-tiet') }}/<% product.slug %>" class="product_quickView" title="Xem nhanh" target="_self">
                                                    <i class="fa fa-search"></i>
                                                </a>

                                                <a href="#" class="product_addtoCart" data-toggle="modal" data-target="#product_quickview" title="Thêm vào giỏ hàng">
                                                    <i class="fa fa-cart-plus"></i>
                                                </a>
                                                @if(!Auth::guest())
                                                    <a href="#" role="button" class="product_like" data-toggle="modal" data-target="#product_like" ng-if="product.like == 'Bỏ yêu thích'" title="<%product.like%>" ng-click="addToLikeProduct1(product.id)">
                                                        <i class="glyphicon glyphicon-heart"></i>
                                                    </a>
                                                    <a href="#" role="button" class="product_like" data-toggle="modal" data-target="#product_like" ng-if="product.like == 'Lưu yêu thích'" title="<%product.like%>" ng-click="addToLikeProduct1(product.id)">
                                                        <i class="glyphicon glyphicon-heart-empty"></i>
                                                    </a>
                                                @else
                                                    <a href="#" role="button" class="product_like" data-toggle="modal" data-target="#product_like"  title="Lưu yêu thích" ng-click="login()">
                                                        <i class="glyphicon glyphicon-heart-empty"></i>
                                                    </a>
                                                @endif


                                                <a href="{{ url('san-pham/chi-tiet') }}/<% product.slug %>"  target="_self"><h4><% product.name %></h4></a>
                                                <p class="price"><% product.price | currency:VND:0 | commaToDot | removeUSCurrency %> vnđ</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slider_controler">
                                        <ul class="list-inline">
                                            <!--<li>
                                                <a class="left carousel-control" href="#itemslider_1" data-slide="prev"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span></a>
                                            </li>
                                            <li>
                                                <a class="right carousel-control" href="#itemslider_1" data-slide="next"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a><strong></strong>
                                            </li>-->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- InstanceEndEditable -->
    </section>
    <script src="{{ asset ("public/frontend/app/controllers/detail-product.js") }}"></script>
    <script src="{{ asset ("public/frontend/app/controllers/modal.js") }}"></script>
    <script src="{{ asset ("public/frontend/js/jquery.flexslider.js") }}"></script>
    <script type="text/javascript">
        $(function(){
            SyntaxHighlighter.all();
        });
        $(window).load(function(){
            setTimeout(function(){
                $('#carousel').flexslider({
                    animation: "slide",
                    controlNav: false,
                    animationLoop: false,
                    slideshow: false,
                    itemWidth: 210,
                    itemMargin: 5,
                    asNavFor: '#slider'
                });

                $('#slider').flexslider({
                    animation: "slide",
                    controlNav: false,
                    animationLoop: false,
                    slideshow: false,
                    sync: "#carousel",
                    start: function(slider){
                        $('body').removeClass('loading');
                    }
                });
            }, 1000);
        });
    </script>
    <script>
        $(window).scroll(function () {
            //if you hard code, then use console
            //.log to determine when you want the
            //nav bar to stick.
            'use strict';
            if ($(window).scrollTop() > 150) {
                $('.main_content').css( 'margin-top' , '280px');
            }
            if ($(window).scrollTop() < 150) {
                $('.main_content').css( 'margin-top' , '50px');
            }
        });
    </script>
@endsection