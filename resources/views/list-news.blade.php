@extends('layouts.frontend-template')
@section('content')
    <link href="{{ asset("public/frontend/css/blog.css")}}" rel="stylesheet" type="text/css" />
    <section class="main_content" ng-controller="BlogController">
        <!-- InstanceBeginEditable name="content" -->
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="row">

                        <div class="col-md-4 col-sm-4 col-xs-12" ng-repeat="new in news">
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
                <div class="nav_side col-md-3 col-sm-3 col-xs-12">
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">Danh mục tin tức</div>

                        <!-- List group -->
                        <ul class="list-group" ng-repeat="category in categories">
                            <li class="list-group-item">
                                <a href="{{ url('tin-tuc/danh-muc') }}/<% category.slug %>" target="_self" ><% category.title %></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- InstanceEndEditable -->
    </section>
    <script src="{{ asset ("public/frontend/app/controllers/blog.js") }}"></script>
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