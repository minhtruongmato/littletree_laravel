@extends('layouts.frontend-template')
@section('content')
    <link href="{{ asset("public/frontend/css/intro.css")}}" rel="stylesheet" type="text/css" />
    <section class="main_content" ng-controller="IntroduceController">
        <!-- InstanceBeginEditable name="content" -->
        <section class="container-fluid" id="about">
            <div class="row" ng-repeat="introduce in introduce">

                <div class="right col-md-6 col-sm-6 col-xs-12 col-md-offset-6 col-sm-offset-6" ng-if="introduce.slug == 've-chung-toi' ">
                    <div class="left hidden-xs"></div>
                    <div class="title_big">
                        Về chúng tôi
                    </div>

                    <p ng-bind-html="$sce.trustAsHtml(introduce.content)"></p>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <i class="fa fa-3x fa-phone" aria-hidden="false"></i>
                            <br>
                            <h4>Hỗ trợ qua điện thoại</h4>
                            <p>Suspendisse potenti. Cras molestie mi sed iaculis varius. Maecenas fermentum semper sagittis. Sed eu mattis tellus. Mauris dolor ligula, pellentesque id vestibulum nec, consectetur sed sem. Aenean at ante enim. Quisque dapibus ligula ut erat laoreet aliquet. Pellentesque dictum magna ante, venenatis scelerisque risus pretium eget. Nullam et orci vitae felis rutrum tempor. Vestibulum id maximus lacus.</p>
                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <i class="fa fa-3x fa-truck" aria-hidden="false"></i>
                            <br>
                            <h4>Miễn phí giao hàng</h4>
                            <p>Suspendisse potenti. Cras molestie mi sed iaculis varius. Maecenas fermentum semper sagittis. Sed eu mattis tellus. Mauris dolor ligula, pellentesque id vestibulum nec, consectetur sed sem. Aenean at ante enim. Quisque dapibus ligula ut erat laoreet aliquet. Pellentesque dictum magna ante, venenatis scelerisque risus pretium eget. Nullam et orci vitae felis rutrum tempor. Vestibulum id maximus lacus.</p>
                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <i class="fa fa-3x fa-user-o" aria-hidden="false"></i>
                            <br>
                            <h4>Hỗ trợ người mua hàng</h4>
                            <p>Suspendisse potenti. Cras molestie mi sed iaculis varius. Maecenas fermentum semper sagittis. Sed eu mattis tellus. Mauris dolor ligula, pellentesque id vestibulum nec, consectetur sed sem. Aenean at ante enim. Quisque dapibus ligula ut erat laoreet aliquet. Pellentesque dictum magna ante, venenatis scelerisque risus pretium eget. Nullam et orci vitae felis rutrum tempor. Vestibulum id maximus lacus.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane" id="<% item.slug %>" ng-repeat="item in introduce" active-on-first-item>
                            {{--<img src="{{ asset('storage/app') }}/<% item.image %>" class="cover" alt="<% item.title %>">--}}
                            <h3><% item.title %></h3>
                            <p ng-bind-html="$sce.trustAsHtml(item.content)"></p>
                        </div>
                    </div>
                </div>

                <div class="nav_side col-md-3 col-sm-3 col-xs-12">
                    <h3>Giới thiệu</h3>
                    <ul class="nav nav-pills nav-stacked" role="tablist">
                        <li role="presentation" class="active"><a href="#ve-chung-toi" aria-controls="ve-chung-toi" role="tab" data-toggle="tab">Về chúng tôi</a></li>
                        <li role="presentation"><a href="#tam-nhin-chien-luoc" aria-controls="tam-nhin-chien-luoc" role="tab" data-toggle="tab">Tầm nhìn chiến lược</a></li>
                        <li role="presentation"><a href="#su-menh" aria-controls="su-menh" role="tab" data-toggle="tab">Sứ mệnh</a></li>
                        <li role="presentation"><a href="#chung-nhan" aria-controls="chung-nhan" role="tab" data-toggle="tab">Chứng nhận</a></li>
                        <li role="presentation"><a href="#dieu-khoan" aria-controls="dieu-khoan" role="tab" data-toggle="tab">Điều khoản</a></li>
                        <li role="presentation"><a href="{{ url('/thu-vien-anh') }}" role="tab" target="_self">Thư viện hình ảnh</a></li>
                    </ul>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="item col-md-4 col-sm-6 col-xs-12">
                            <div class="mask">
                                <a class="preview" href="{{ asset ("public/frontend/img/blog_02.jpg") }}">
                                    <img src="{{ asset ("public/frontend/img/blog_02.jpg") }}" alt="anh minh hoa">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- InstanceEndEditable -->
    </section>
    <script src="{{ asset ("public/frontend/app/controllers/introduce.js") }}"></script>
@endsection