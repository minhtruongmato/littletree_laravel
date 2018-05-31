@extends('layouts.frontend-template')
@section('content')
    <link href="{{ asset("public/frontend/css/blog.css")}}" rel="stylesheet" type="text/css" />
    <section class="main_content" ng-controller="SearchController">
        <!-- InstanceBeginEditable name="content" -->
        <div class="container">
        	<h3>Sản phẩm</h3>
            <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="row">

                        <div class="col-md-4 col-sm-4 col-xs-12" ng-repeat="product in searchProduct">
                            <div class="inner">
                                <div class="mask">
                                    <img src="{{ asset('storage/app') }}/<% product.image[0] %>" alt="ảnh mình họa bài viết">
                                </div>

                                <a href="#">
                                    <h3><% product.name %></h3>
                                </a>
                                <br>
                                <p ng-bind-html="$sce.trustAsHtml(product.description)"></p>
                                <br>
                                <a href="{{ url('/san-pham/chi-tiet') }}/<% product.slug %>" class="btn btn-primary" target="_self" >Xem thêm <i class="fa fa-angle-double-right" aria-hidden="false"></i> </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        	<h3>Bài viết</h3>
            <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="row">

                        <div class="col-md-4 col-sm-4 col-xs-12" ng-repeat="new in searchBlog">
                            <div class="inner">
                                <div class="mask">
                                    <img src="{{ asset('storage/app') }}/<% new.image %>" alt="ảnh mình họa bài viết">
                                </div>

                                <a href="#">
                                    <h3><% new.title %></h3>
                                </a>
                                <br>
                                <p ng-bind-html="$sce.trustAsHtml(new.description)"></p>
                                <br>
                                <a href="{{ url('/tin-tuc') }}/<% new.slug %>" class="btn btn-primary" target="_self" >Xem thêm <i class="fa fa-angle-double-right" aria-hidden="false"></i> </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- InstanceEndEditable -->
    </section>
    <script src="{{ asset ("public/frontend/app/controllers/search.js") }}"></script>
@endsection
