<!DOCTYPE html>
<!--
  This is a starter template page. Use this page to start your new project from
  scratch. This page gets rid of all links and provides the needed markup only.
  -->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hầm rượu Thịnh 24</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link href="{{ asset("public/frontend/css/lib/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome -->
    <link href="{{ asset("public/frontend/css/lib/font-awesome.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Theme style -->
    <link href="{{ asset("public/frontend/css/font_settings.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("public/frontend/css/main.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("public/frontend/css/reset.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("public/frontend/css/cart.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("public/frontend/css/checkout.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("public/frontend/css/intro.css")}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset("public/frontend/theme/original/css/theme.css")}}" rel="stylesheet" type="text/css" /> <!--THEME CSS-->

    <script src="{{ asset ("public/frontend/js/lib/jquery-1.9.1.min.js") }}"></script>
    <script src="{{ asset ("public/frontend/js/lib/bootstrap.js") }}"></script>
    <script src="{{ asset ("public/frontend/app/lib/angular-1.6.6/angular.min.js") }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.5/angular-animate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.5/angular-aria.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-material/1.1.5/angular-material.min.js"></script>
    <script src="{{ asset ("public/frontend/app/lib/angular-1.6.6/angular-route.js") }}"></script>
    <script src="{{ asset ("public/frontend/app/lib/angular-1.6.6/angular-resource.js") }}"></script>
    <script src="{{ asset ("public/frontend/app/lib/angular-1.6.6/angular-cookies.js") }}"></script>

    <script src="{{ asset ("public/frontend/js/lib/ui-bootstrap-tpls-2.5.0.min.js") }}"></script>
    <script src="{{ asset ("public/frontend/js/script.js") }}"></script>
    <script src="{{ asset ("public/frontend/js/nav_responsive.js") }}"></script>
    <script src="{{ asset ("public/frontend/js/lib/js.cookie.js") }}"></script>
    <!-- Angularjs -->
    <link rel="stylesheet" href="{{ asset ("public/frontend/rating/jk-rating-stars.min.css") }}" />
    <script src="{{ asset ("public/frontend/rating/jk-rating-stars.min.js") }}"></script>

    <script src="{{ asset ("public/frontend/app/app.js") }}"></script>
    <script src="{{ asset ("public/frontend/app/controllers/main.js") }}"></script>
    <script src="{{ asset ("public/frontend/app/controllers/subscribe.js") }}"></script>
    <script src="{{ asset ("public/frontend/app/controllers/quotation.js") }}"></script>
    <script src="{{ asset ("public/frontend/app/controllers/library.js") }}"></script>
    <script src="{{ asset ("public/frontend/app/controllers/search.js") }}"></script>
    <script src="{{ asset ("public/frontend/app/controllers/likeproduct.js") }}"></script>



    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <style type="text/css">
        /* Styles go here */

        .my-custom-stars .button .material-icons {
          font-size: 50px; 
        }

        .my-custom-stars .star-button.star-on .material-icons {
          color: #003399; 
        }

        .my-custom-stars .star-button.star-off .material-icons {
          color: #99ccff; 
        }
    </style>
</head>

<body ng-app="hamruouthinh24App" ng-controller="MainController">
<!-- Main Header -->
@include('layouts.header')
@yield('content')
<!-- /.content-wrapper -->
<!-- Footer -->
@include('layouts.footer')





<!-- Modal -->
<div class="modal fade" id="user_login" tabindex="-1" role="dialog" aria-labelledby="user_login_Label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="user_login_Label">Đăng nhập</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    {{ Form::hidden('type', 'normalLogin') }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">Email</label>

                        <div class="col-md-6">
                            <input id="login_email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Mật khẩu</label>

                        <div class="col-md-6">
                            <input id="login_password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Lưu thông tin đăng nhập
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Đăng nhập
                            </button>

                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Quên mật khẩu?
                            </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                        Đăng nhập qua
                        <a class="btn btn-default btn-facebook btn-sm" href="#" role="button">Facebook</a>
                        <a class="btn btn-default btn-google btn-sm" href="#" role="button">Google +</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="user_register" tabindex="-1" role="dialog" aria-labelledby="user_register_Label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="user_register_Label">Đăng ký</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Họ tên</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                        <label for="birthday" class="col-md-4 control-label">Ngày sinh</label>

                        <div class="col-md-6">
                            <input id="birthday" type="text" class="form-control" name="birthday" value="{{ old('birthday') }}" required readonly>

                            @if ($errors->has('birthday'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('birthday') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label for="phone" class="col-md-4 control-label">Số điện thoại</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>

                            @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">Email</label>

                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Đăng ký
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="requestQuotation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" ng-controller="QuotationController">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    Đăng ký nhận báo giá
                </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Họ tên</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus ng-model="quotation.name">

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label for="phone" class="col-md-4 control-label">Số điện thoại</label>

                        <div class="col-md-6">
                            <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required ng-model="quotation.phone">

                            @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">Email</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required ng-model="quotation.email">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-md-4 control-label" value="{{ old('email') }}" ng-model="quotation.content">Tin nhắn</label>

                        <div class="col-md-6">
                            <textarea class="form-control" placeholder="Xin chào, chúng tôi muốn nhận báo giá về rượu ..." value="Xin chào, chúng tôi muốn nhận báo giá về rượu ..."></textarea>
                        </div>
                    </div>

                    {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <input type="submit" ng-click="send(quotation)" class="btn btn-primary btn-quotation" value="Đăng ký" />
                        </div>
                    </div>--}}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary btn-quotation" ng-click="send(quotation)">Gửi tin nhắn</button>
            </div>
        </div>
    </div>
</div>

<div id="before-send" style="display: none;">
    <div class="modal fade" role="dialog" style="display: block; opacity: .5; background-color: rgba(0,0,0,.65);">
        <div class="modal-dialog" style="color:#fff; text-align:center; padding-top:300px;">
            <i class="fa fa-2x fa-spinner fa-spin" aria-hidden="true"></i>
        </div>
    </div>
</div>

<script>
        $('#birthday').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy'
        });
</script>
</body>
</html>