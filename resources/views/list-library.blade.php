@extends('layouts.frontend-template')
@section('content')
    <link href="{{ asset("public/frontend/css/intro.css")}}" rel="stylesheet" type="text/css" />
    <section class="main_content" ng-controller="LibraryController">
    	<div class="container">
			<div class="row">
	    		<div class="item col-md-4 col-sm-6 col-xs-12" ng-repeat="item in library">
	                <div class="mask">
	                	<h3><% item.title %></h3>
	                    <a class="preview" href="{{ url('/thu-vien-anh') }}/<% item.slug %>" target="_self">
	                        <img src="{{ asset('storage/app/library') }}/<% item.slug %>/<% item.image %>" class="cover" alt="<% item.title %>">
	                    </a>
	                </div>
	            </div>
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
    	
    </section>
    <script src="{{ asset ("public/frontend/app/controllers/library.js") }}"></script>
@endsection