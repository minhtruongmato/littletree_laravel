@extends('layouts.frontend-template')
@section('content')
    <link href="{{ asset("public/frontend/css/cart.css")}}" rel="stylesheet" type="text/css" />

    <section class="main_content" ng-controller="CartController">
        <!-- InstanceBeginEditable name="content" -->
        <div class="container">
            <div class="row">
                <div class="right container-fluid">
                    <div class="row">
                        <div class="title_mid">
                            <h3><i class="fa fa-shopping-cart"></i> Giỏ hàng</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td>STT</td>
                                    <td colspan="2">Sản phẩm</td>
                                    <td>Đơn giá</td>
                                    <td>Số lượng</td>
                                    <td>Thành tiền</td>
                                    <td>Hủy sản phẩm</td>
                                </tr>
                                </thead>
                                <tbody>

                                <tr ng-repeat="product in fetchedProducts" id="cartItem<% product.id %>">
                                    <td><% $index + 1 %></td>
                                    <td><% product.name %></td>
                                    <td><img src="{{ asset('storage/app/products') }}/<% product.slug %>/<% product.image[0] %>"></td>
                                    <td><% product.cost | currency:VND:0 | commaToDot | removeUSCurrency %> VNĐ</td>
                                    <td>
                                        <input class="form-control" type="number" min="1" ng-model="inputQuantity" ng-change="calculatePrice(inputQuantity, $index)" ng-value="product.quantity">
                                    </td>
                                    <td><% product.totalCost | currency:VND:0 | commaToDot | removeUSCurrency %> VNĐ</td>
                                    <td><button class="btn btn-danger" type="button" ng-click="removeFromCart($index);"><i class="fa fa-ban"></i> Xóa sản phẩm</button></td>
                                </tr>
                                <tr ng-if="isEmpty(fetchedProducts)">
                                    <td colspan="6">Bạn chưa có sản phẩm nào!</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        @if (Auth::guest())
                            <a class="btn btn-primary" role="button" data-toggle="modal" data-target="#checkLogIn">Đặt mua</a>
                        @else
                            <a href="{{ 'xac-nhan-thong-tin-ca-nhan' }}" class="btn btn-primary" target="_self">Đặt mua</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- InstanceEndEditable -->
        <!-- Modal -->
        <div class="modal fade" id="checkLogIn" tabindex="-1" role="dialog" aria-labelledby="checkLogInLabel">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                {{ Form::hidden('type', 'cartLogin') }}
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                        </div>

                        <div class="modal-body">
                            <h4 class="modal-title" id="user_login_Label">Bạn chưa đăng nhập</h4>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" style="height:30px">
                                <label for="email" class="col-md-4 control-label">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" ng-disabled="disabled" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" style="height:30px">
                                <label for="password" class="col-md-4 control-label">Mật khẩu</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" ng-disabled="disabled" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                @endif
                                <!--<a class="pull-right" href="javascript:void();">Quên mật khẩu</a>-->
                                </div>


                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" ng-change="changeLoginCart()" ng-model="checkLogin.check" value="loginCart">
                                    Mua hàng theo tài khoản đăng nhập
                                </label>
                            </div>
                            <p>Hoặc</p>
                            <div class="radio">
                                <label>
                                    <input type="radio" ng-change="changeLoginCart()" ng-model="checkLogin.check" value="guestCart">
                                    Mua hàng không cần đăng nhập
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" ng-if="toStepTwo == 'loginCart'">
                                Đăng nhập <i class="fa fa-arrow-right"></i>
                            </button>
                            <a href="{{ 'xac-nhan-thong-tin-ca-nhan' }}" role="button" class="btn btn-primary" ng-if="toStepTwo == 'guestCart'" target="_self">
                                Tiếp tục <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script src="{{ asset ("public/frontend/app/controllers/cart.js") }}"></script>
@endsection