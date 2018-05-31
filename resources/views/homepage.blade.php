@extends('layouts.frontend-template')
@section('content')
    <link href="{{ asset("public/frontend/css/style_slide_product.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("public/frontend/css/homepage.css")}}" rel="stylesheet" type="text/css" />

    <section class="big_cover">
        <div class="content">
            <h3>save water</h3>
            <h1>drink wine</h1>
            <br>
            <a class="btn btn-primary" href="#scroll_point" role="button">Khám phá ngay</a>
        </div>
    </section>
    <section class="main_content" ng-controller="HomepageController" id="main_content">
        <span id="scroll_point"></span>
        <section class="container">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item" ng-repeat="advise in advises" active-on-first-four-items>
                        <div class="row">
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <img src="{{ asset('storage/app') }}/<% advise.image %>" alt="<% advise.slug %>">
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <a href="{{ url('/tu-van') }}/<% advise.slug %>" class="link-primary" target="_self">
                                    <h1><% advise.title %></h1>
                                </a>
                                <article class="description">
                                    <p ng-bind-html="$sce.trustAsHtml(advise.description)"></p>
                                </article>

                                <a class="btn btn-primary" href="{{ url('/tu-van') }}/<% advise.slug %>" role="button" target="_self">Khám phá ngay</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </section>
        <section class="container" id="product_list">
            <div class="row">
                <!--<div class="col-md-3 col-sm-3 col-xs-12">
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

                <div class="container-fluid">
                    <div class="title_big">
                        Sản phẩm khuyến mãi
                    </div>

                    <div class="row">
                        <div class="item col-md-3 col-sm-6 col-xs-12" ng-repeat="discount in discounts">
                            <div class="inner">
                                <div class="mask">
                                    <img src="{{ asset('storage/app/products/') }}/<% discount.slug %>/<% discount.image[0] %>" alt="<% discount.slug %>">
                                </div>

                                <span class="badge">- <% discount.discount_percent %>%</span>

                                <span class="productName"><% discount.name %></span>
                                <h4 class="productYear"><% discount.year %></h4>
                                <h3 class="productPrice"><% discount.price | currency:VND:0 | commaToDot | removeUSCurrency  %> vnđ</h3>
                                <br>
                                <a class="btn btn-primary" href="#" role="button">Thử rượu miễn phí</a>

                                <div class="hover">
                                    <span class="productName"><% discount.name %></span>
                                    <h4 class="productYear"><% discount.year %></h4>
                                    <h3 class="productPrice"><% discount.price | currency:VND:0 | commaToDot | removeUSCurrency  %> vnđ</h3>
                                    <br>
                                    <!--<p ng-bind-html="$sce.trustAsHtml(discount.description)"></p>-->
                                    <br>
                                    <a class="btn btn-primary" href="#" role="button" ng-click="addToCart(discount.id)">Thêm vào giỏ hàng</a>
                                    <br>
                                    <a class="btn btn-primary" href="{{ url('/san-pham/chi-tiet') }}/<% discount.slug %>" role="button"  target="_self" >Xem chi tiết</a>
                                    <br>
                                    <a class="btn btn-primary" href="#" role="button" ng-click="addToTasting(discount.id)">Thử rượu miên phí</a>
                                    @if(!Auth::guest())
                                        <br>
                                        <a class="btn btn-primary" href="#" role="button" ng-click="addToLikeProduct(discount.id)" ><% discount.like %></a>
                                    @else
                                        <br>
                                        <a class="btn btn-primary" href="#" role="button" ng-click="login()" >Lưu yêu thích</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section class="container-fluid" id="tasting_wine">
            <div class="row">
                <div class="left col-md-4 col-sm-6 col-xs-12 col-md-offset-1 col-sm-offset-1">
                    <div class="title_mid">
                        Đăng ký thử rượu
                    </div>

                    <h2>Maecenas pulvinar tristique malesuada</h2>
                    <p>Vivamus ac tempor quam. Maecenas pulvinar tristique malesuada. Donec euismod nibh et dapibus tempor. Nullam elit nulla, rutrum eget eros sollicitudin, ullamcorper ultrices orci. Suspendisse potenti. Ut porta bibendum nibh eu viverra. Sed vel magna ac ligula finibus fermentum fringilla eu lectus. Sed elit ante, ornare nec dui at, molestie congue arcu. Nam at imperdiet neque, non tempus libero. Praesent dolor odio, mattis vulputate est ut, vulputate sollicitudin metus. Nulla id metus turpis. Phasellus non diam nisi. Duis vitae felis et magna elementum dictum. Pellentesque in enim fringilla, ullamcorper lacus et, imperdiet erat.</p>

                    <a class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#tastingWine_UG">Huong dan dang kys thu ruou</a>
                </div>
            </div>
        </section>

        <section class="container-fluid" id="news">
            <div class="container">
                <div class="title_big">
                    Tin tức
                </div>
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
        </section>

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
        <!-- InstanceEndEditable -->
    </section>

    <div class="modal fade" id="tastingWine_UG" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Huong dan dang ky thu ruou</h4>
                </div>
                <div class="modal-body">
                    <div class="cover">
                        <img src="{{ asset('public/frontend/img/cover/cover_02.jpg') }}" alt="cover">
                    </div>
                    <article>
                        <ol>
                            <li>
                                <h3>Buoc 1:</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquam pretium sapien, et gravida nisl vehicula a. Fusce nec augue eu velit tempus finibus in id diam. Vivamus pellentesque orci molestie justo dapibus, id posuere lectus placerat. Cras ut eros rutrum magna accumsan bibendum. Quisque laoreet, elit sit amet imperdiet euismod, lacus mauris consectetur orci, eget aliquam odio ante a massa. Vestibulum convallis egestas dignissim. Donec sit amet iaculis odio.</p>
                                <p>Morbi vel maximus ex. Vivamus sit amet cursus orci. Aliquam cursus bibendum lacus, quis congue justo. In volutpat, magna sit amet porta gravida, ante erat sodales eros, eget malesuada magna est vitae magna. Phasellus laoreet pharetra scelerisque. Nunc ex mauris, cursus eu ex a, mollis tempus nisi. Integer eleifend justo quam, a imperdiet urna pretium at. Sed porta nulla ut odio volutpat auctor. Maecenas et metus lacus. Integer metus sem, iaculis vel suscipit vel, aliquam at justo. Quisque quis condimentum nibh. Suspendisse hendrerit consequat ipsum, in malesuada urna vestibulum nec. Ut maximus, mi ut sodales lacinia, mauris eros varius lorem, et convallis felis diam eu sapien. Donec sollicitudin, nisl a blandit euismod, risus mauris tristique lectus, sed dignissim quam risus sit amet massa.</p>
                            </li>
                            <li>
                                <h3>Buoc 2:</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquam pretium sapien, et gravida nisl vehicula a. Fusce nec augue eu velit tempus finibus in id diam. Vivamus pellentesque orci molestie justo dapibus, id posuere lectus placerat. Cras ut eros rutrum magna accumsan bibendum. Quisque laoreet, elit sit amet imperdiet euismod, lacus mauris consectetur orci, eget aliquam odio ante a massa. Vestibulum convallis egestas dignissim. Donec sit amet iaculis odio.</p>
                                <p>Morbi vel maximus ex. Vivamus sit amet cursus orci. Aliquam cursus bibendum lacus, quis congue justo. In volutpat, magna sit amet porta gravida, ante erat sodales eros, eget malesuada magna est vitae magna. Phasellus laoreet pharetra scelerisque. Nunc ex mauris, cursus eu ex a, mollis tempus nisi. Integer eleifend justo quam, a imperdiet urna pretium at. Sed porta nulla ut odio volutpat auctor. Maecenas et metus lacus. Integer metus sem, iaculis vel suscipit vel, aliquam at justo. Quisque quis condimentum nibh. Suspendisse hendrerit consequat ipsum, in malesuada urna vestibulum nec. Ut maximus, mi ut sodales lacinia, mauris eros varius lorem, et convallis felis diam eu sapien. Donec sollicitudin, nisl a blandit euismod, risus mauris tristique lectus, sed dignissim quam risus sit amet massa.</p>
                            </li>
                            <li>
                                <h3>Buoc 3:</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquam pretium sapien, et gravida nisl vehicula a. Fusce nec augue eu velit tempus finibus in id diam. Vivamus pellentesque orci molestie justo dapibus, id posuere lectus placerat. Cras ut eros rutrum magna accumsan bibendum. Quisque laoreet, elit sit amet imperdiet euismod, lacus mauris consectetur orci, eget aliquam odio ante a massa. Vestibulum convallis egestas dignissim. Donec sit amet iaculis odio.</p>
                                <p>Morbi vel maximus ex. Vivamus sit amet cursus orci. Aliquam cursus bibendum lacus, quis congue justo. In volutpat, magna sit amet porta gravida, ante erat sodales eros, eget malesuada magna est vitae magna. Phasellus laoreet pharetra scelerisque. Nunc ex mauris, cursus eu ex a, mollis tempus nisi. Integer eleifend justo quam, a imperdiet urna pretium at. Sed porta nulla ut odio volutpat auctor. Maecenas et metus lacus. Integer metus sem, iaculis vel suscipit vel, aliquam at justo. Quisque quis condimentum nibh. Suspendisse hendrerit consequat ipsum, in malesuada urna vestibulum nec. Ut maximus, mi ut sodales lacinia, mauris eros varius lorem, et convallis felis diam eu sapien. Donec sollicitudin, nisl a blandit euismod, risus mauris tristique lectus, sed dignissim quam risus sit amet massa.</p>
                            </li>
                        </ol>
                    </article>

                    <a href="{{ url('san-pham') }}" target="_self" role="button" class="btn btn-primary">
                        Sản phẩm
                    </a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset ("public/frontend/app/controllers/homepage.js") }}"></script>
    <script src="{{ asset ("public/frontend/app/controllers/modal.js") }}"></script>
@endsection
