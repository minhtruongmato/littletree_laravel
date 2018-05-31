@extends('layouts.frontend-template')
@section('content')
    <link href="{{ asset("public/frontend/css/store.css")}}" rel="stylesheet" type="text/css" />
    <section class="main_content" ng-controller="ProductController">
        <!-- InstanceBeginEditable name="content" -->
        <div class="container">
            <div class="container-fluid">
                <img class="cover" src="{{ asset('public/frontend/img/cover/cover_01.jpg') }}" alt="cover">

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

            <div class="row">
                <div class="category col-md-3 col-sm-3 col-xs-12">
                    
                    <div class="panel panel-default filter">
                        <div class="panel-heading">
                            Tìm kiếm sản phẩm
                        </div>
                        {{--                        <form method="POST" action="{{ route('product.search') }}" ng-submit="search()">--}}
                        <form method="POST" ng-submit="searchTarget()">
                            {{ csrf_field() }}
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <label>Tìm kiếm sản phẩm</label>
                                    <div class="input-group">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Tìm kiếm..." ng-model="name">

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <label>Mức giá</label>
                                    <div class="checkbox">
                                        <select name="price" ng-model="price">
                                            <option value="">Chọn mức giá</option>
                                            <option value="0" @if (old('price') == "0") selected="selected" @endif> 0-100.000 vnđ</option>
                                            <option value="1" @if (old('price') == "1") selected="selected" @endif> 101.000-300.000 vnđ</option>
                                            <option value="2" @if (old('price') == "2") selected="selected" @endif> 301.000-500.000 vnđ</option>
                                            <option value="3" @if (old('price') == "3") selected="selected" @endif> 501.000-800.000 vnđ</option>
                                            <option value="4" @if (old('price') == "4") selected="selected" @endif> 800.000+ vnđ</option>
                                        </select>
                                        @if ($errors->has('price'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <label>Xuất xứ</label>
                                    <div class="radio">
                                        <select name="origin" ng-model="origin">
                                            <option value="">Chọn quốc gia</option>
                                            <option ng-repeat="origin in origins" value="<% origin.id%>"><% origin.name%></option>
                                        </select>
                                    </div>
                                </li>
                            </ul>
                            <div class="panel-footer">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i> Tìm kiếm
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="productItem_view col-md-9">
                    {{--<img class="cover" src="{{ asset('storage/app') }}/<% coverImage %>" alt="cover" ng-if="coverImage">--}}


                    {{--
                    <div class="row" id="list-product">
                        <div class="product_view col-md-4 col-sm-6 col-xs-12" ng-repeat="product in targetProducts">
                            <a href="#"><img src="{{ asset('storage/app') }}/<% product.image[0] %>" class="img-responsive center-block"></a>
                            <a href="" class="product_quickView" data-toggle="modal" data-target="#product_quickView" title="Xem nhanh" ng-click="openTarget(product)"><i class="fa fa-search"></i></a>
                            <a href="#" class="product_addtoCart" data-toggle="modal" data-target="#product_quickview" title="Thêm vào giỏ hàng" ng-click="addToCart(product.id)"><i class="fa fa-cart-plus"></i></a>
                            <a href="{{ url('san-pham/chi-tiet') }}/<% product.slug %>" target="_self"><h4><% product.name %></h4></a>
                            <span class="price"><% product.price | currency:VND:0 | commaToDot | removeUSCurrency  %> vnđ</span>
                        </div>
                    </div>

                    --}}

                    <div class="row" id="list-product">
                        <div class="item col-md-4 col-sm-6 col-xs-12" ng-repeat="product in targetProducts">
                            <div class="inner">
                                <div class="mask">
                                    <img src="{{ asset('storage/app') }}/<% product.image[0] %>" alt="<% product.slug %>">
                                </div>

                                <span class="badge" ng-if="product.discount_percent != null">- <% product.discount_percent %>%</span>

                                <span class="productName"><% product.name %></span>
                                <h4 class="productYear"><% product.year %></h4>
                                <h3 class="productPrice"><% product.price %> vnđ</h3>
                                <br>
                                <a class="btn btn-primary" href="#" role="button">Đăng ký thử rượu</a>

                                <div class="hover">
                                    <span class="productName"><% product.name %></span>
                                    <h4 class="productYear"><% product.year %></h4>
                                    <h3 class="productPrice"><% product.price %> vnđ</h3>
                                    <br>
                                    <p ng-bind-html="$sce.trustAsHtml(product.description)"></p>
                                    <br>
                                    <a class="btn btn-primary" href="#" role="button" ng-click="addToCart(product.id)">Thêm vào giỏ hàng</a>
                                    <br>
                                    <a class="btn btn-primary" href="{{ url('/san-pham/chi-tiet') }}/<% product.slug %>" role="button"  target="_self" >Xem chi tiết</a>
                                    <br>
                                    <a class="btn btn-primary" href="#" role="button" ng-click="addToTasting(product.id)">Đăng ký thử rượu</a>
                                    @if(!Auth::guest())
                                        <br>
                                        <a class="btn btn-primary" href="#" role="button" ng-click="addToLikeProduct(product.id)" ><% product.like %></a>
                                    @else
                                        <br>
                                        <a class="btn btn-primary" href="#" role="button" ng-click="login()" >Lưu yêu thích</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" ng-if="isEmpty(targetProducts)">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h4>Chúng tôi không tìm thấy sản phẩm của bạn!</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- InstanceEndEditable -->
    </section>
    <script src="{{ asset ("public/frontend/app/controllers/product.js") }}"></script>
    <script src="{{ asset ("public/frontend/app/controllers/modal.js") }}"></script>
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