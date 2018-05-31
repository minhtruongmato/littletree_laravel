@extends('layouts.frontend-template')
@section('content')
    <link href="{{ asset("public/frontend/css/intro.css")}}" rel="stylesheet" type="text/css" />
    <section class="main_content" ng-controller="DetailLibraryController">
    	<div class="container">
			<div class="row">
	    		<div class="item col-md-4 col-sm-6 col-xs-12" ng-repeat="image in detail.image">
	                <div class="mask">
                        <img src="{{ asset('storage/app/library') }}/<% detail.slug %>/<% image['image'] %>" class="cover" alt="<% item.title %>">
	                </div>
	            </div>
	            
	    	</div>
    	</div>
    	
    </section>
    <script src="{{ asset ("public/frontend/app/controllers/detail-library.js") }}"></script>
@endsection