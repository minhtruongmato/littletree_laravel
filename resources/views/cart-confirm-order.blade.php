@extends('layouts.frontend-template')
@section('content')
    <link href="{{ asset("public/frontend/css/checkout.css")}}" rel="stylesheet" type="text/css" />

    <section class="main_content" ng-controller="CartController">
        <!-- InstanceBeginEditable name="content" -->
        <div class="container">
            <div class="col-md-10 col-sm-12 col-md-offset-1">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 alert alert-success" ng-show="showMessage">
                        <h3><strong><% successMessage1 %></strong></h3>
                        <h4><strong><% successMessage2 %></strong><strong style="color: red"><% orderCode | uppercase %></strong></h4>
                        <h4 ng-show="customerInfo.paymentMethod == 2"><% successMessage3 %><strong style='color:red'><% customerInfo.name %> <% orderCode | uppercase %></strong></h4>
                        <br>
                        {{--<h3><strong><% successMessage2 %></strong></h3>--}}
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <h3><strong>Thông tin khách hàng</strong></h3>

                        <h5><strong>Họ tên (*)</strong></h5>
                        <% customerInfo.name %>
                        <h5><strong>Email</strong></h5>
                        <% customerInfo.email %>
                        <h5><strong>Điện thoại</strong></h5>
                        <% customerInfo.phone %>
                        <h5><strong>Địa chỉ giao hàng</strong></h5>
                        <% customerInfo.address %>
                        <br>
                        <% customerInfo.district %>
                        <br>
                        <% customerInfo.city %>
                        <h5><strong>Ghi chú đơn hàng</strong></h5>
                        <% customerInfo.content %>

                        <h3><strong>Hình thức thành toán</strong></h3>
                        Thanh toán khi giao hàng (COD)
                    </div>

                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <h3><strong>Nội dung đơn hàng</strong></h3>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <td><strong>Sản phẩm</strong></td>
                                        <td><strong>Số lượng</strong></td>
                                        <td><strong>Thành tiền</strong></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="product in fetchedProducts">
                                        <td><% product.name %></td>
                                        <td><% product.quantity %></td>
                                        <td><% product.totalCost | currency:VND:0 | commaToDot | removeUSCurrency %> vnđ</td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="2"><strong>Tạm tính</strong></td>
                                        <td><% getTotalOrderCost() | currency:VND:0 | commaToDot | removeUSCurrency %> vnđ</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><strong>Phí vận chuyển</strong></td>
                                        <td>0 vnđ</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><strong>Tổng cộng</strong></td>
                                        <td><% getTotalOrderCost() | currency:VND:0 | commaToDot | removeUSCurrency %> vnđ</td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <button class="btn btn-primary" ng-disabled="hideButton" ng-click="checkout()">Đặt hàng</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- InstanceEndEditable -->
    </section>
    <script src="{{ asset ("public/frontend/app/controllers/cart.js") }}"></script>
@endsection