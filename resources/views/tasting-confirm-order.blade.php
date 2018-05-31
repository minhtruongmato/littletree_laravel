@extends('layouts.frontend-template')
@section('content')
    <link href="{{ asset("public/frontend/css/checkout.css")}}" rel="stylesheet" type="text/css" />

    <section class="main_content" ng-controller="TastingController">
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
                    <div class="container-fluid">

                        <table class="table">
                            <thead>
                                <tr>
                                    <td colspan="2">
                                        <h3><strong>Thông tin khách hàng</strong></h3>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><h5><strong>Họ tên (*)</strong></h5></td>
                                    <td><% customerInfo.name %></td>
                                </tr>
                                <tr>
                                    <td><h5><strong>Email</strong></h5></td>
                                    <td><% customerInfo.email %></td>
                                </tr>
                                <tr>
                                    <td><h5><strong>Điện thoại</strong></h5></td>
                                    <td><% customerInfo.phone %></td>
                                </tr>
                                <tr>
                                    <td><h5><strong>Số người thử rượu</strong></h5></td>
                                    <td><% customerInfo.people %></td>
                                </tr>
                                <tr>
                                    <td><h5><strong>Địa chỉ thử rượu</strong></h5></td>
                                    <td ng-if="customerInfo.store == 0">
                                        <% customerInfo.address %>
                                        <br>
                                        <% customerInfo.district %>
                                        <br>
                                        <% customerInfo.city %>
                                    </td>
                                    <td ng-if="customerInfo.store == 1">Tại cửa hàng</td>
                                </tr>
                                <tr>
                                    <td><h5><strong>Thời gian thử rượu</strong></h5></td>
                                    <td><% customerInfo.hour %>h : <% customerInfo.minute %> / <% customerInfo.time %></td>
                                </tr>
                                <tr>
                                    <td><h5><strong>Ghi chú</strong></h5></td>
                                    <td><% customerInfo.content %></td>
                                </tr>

                            </tbody>
                        </table>





                        <br>
                        <br>
                        <br>
                        <button class="btn btn-primary" ng-disabled="hideButton" ng-click="checkout()">Đặt Lịch</button>
                    </div>
                </div>
            </div>
        </div>

        
        <!-- InstanceEndEditable -->
    </section>
    <script src="{{ asset ("public/frontend/app/controllers/tasting.js") }}"></script>
@endsection