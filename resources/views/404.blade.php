@extends('layouts.frontend-template')
@section('content')
    <link href="{{ asset("public/frontend/css/page404.css")}}" rel="stylesheet" type="text/css" />
    <section class="main_content" ng-controller="IntroduceController">
        <div class="container">
            <div class="jumbotron">
                <h1>404 page</h1>
                <p>Trang bạn đang tới không tồn tại</p>
                <p>
                    <a class="btn btn-primary btn-lg" href="#" role="button" onclick="goBack()">Quay trở lại</a>
                </p>
            </div>
        </div>
    </section>

    <script>
        function goBack(){
            window.history.back();
        }
    </script>
@endsection