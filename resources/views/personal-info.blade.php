@extends('layouts.frontend-template')
@section('content')
    <section class="main_content" ng-controller="CustomerController">
        <!-- InstanceBeginEditable name="content" -->
        <div class="container">
            <div class="row">
                @if (Auth::guest())
                <p>Chỉ dành cho thành viên đã đăng ký
                @else
                <div class="left col-md-4 col-sm-12 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tài khoản của tôi
                        </div>
                        @if (Auth::guest())
                            <input type="hidden" name="hidden" value="0" />
                        @else
                            <input type="hidden" name="hidden" value="{{ Auth::user()->id }}" />
                        @endif
                        <ul class="list-group">
                            <li class="list-group-item">
                                <h3>Thông tin cá nhân</h3>
                                <label>Họ tên:</label>
                                <h4>{{ Auth::user()->name }}</h4>
                                <label>Ngày sinh:</label>
                                <h4>{{ date('d/m/Y', strtotime(Auth::user()->dob)) }}</h4>
                                <label>Điện thoại:</label>
                                <h4>{{ Auth::user()->phone }}</h4>
                                <label>Email:</label>
                                <h4>{{ Auth::user()->email }}</h4>
                                <a class="btn btn-primary" href="#" role="button" ng-click="getCustomerInfo(customerInfo)" data-toggle="modal" data-target="#edit_personal">Chỉnh sửa</a>
                            </li>
                            <li class="list-group-item">
                                <label>Địa chỉ giao hàng:</label>
                                @if(!empty(Auth::user()-> address))
                                <h4>{{ Auth::user()-> address . ', ' . Auth::user()->district . ', ' . Auth::user()->city }}</h4>
                                @else
                                <h4>Chưa cập nhật</h4>
                                @endif
                                {{--<h3>Thông tin thanh toán</h3>--}}
                                {{--<label>Cách thức thanh toán:</label>--}}
                                {{--<h4>Thẻ quốc tế</h4>--}}
                                {{--<label>Ngân hàng:</label>--}}
                                {{--<h4>VCB-Vietcombank</h4>--}}
                                {{--<a class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#edit_payment">Chỉnh sửa</a>--}}
                            </li>

                        </ul>
                    </div>
                </div>
                @endif
                <div class="right col-md-8 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="title_mid">
                            <h3><i class="fa fa-file-text-o"></i> Theo dõi đơn hàng</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td>STT</td>
                                    <td>Sản phẩm</td>
                                    <td>Giá trị đơn hàng</td>
                                    <td>Thời gian đặt hàng</td>
                                    <td>Tình trạng</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="order in notCompleteOrders" ng-show="notCompleteOrdersMessage == 'Success'">
                                    <td><% $index + 1 %></td>
                                    <td><a class="btn btn-primary" href="#" role="button" ng-click="showOrderProductsInfo(order.product_info)" data-toggle="modal" data-target="#edit_personal">Xem đơn hàng</a></td>
                                    <td><% order.price | currency:VND:0 | commaToDot | removeUSCurrency %> VNĐ</td>
                                    <td><% formatDate(order.created_at) | date: 'dd/MM/yyyy hh:mm' %></td>
                                    <td ng-if="order.status == 0"><p class="text-success" style="color:blue">Đang chờ xác nhận</p></td>
                                    <td ng-if="order.status == 1"><p class="text-success" style="color:green">Đang thực hiện</p></td>
                                </tr>
                                <tr ng-show="notCompleteOrdersMessage == 'No item found'">
                                    <td colspan="6">Bạn chưa có đơn hàng nào!</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="title_mid">
                            <h3><i class="fa fa-history"></i> Lịch sử mua hàng</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td>STT</td>
                                    <td>Sản phẩm</td>
                                    <td>Giá trị đơn hàng</td>
                                    <td>Thời gian đặt hàng</td>
                                    <td>Thời gian hoàn thành</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="order in completeOrders" ng-show="completeOrdersMessage == 'Success'">
                                    <td><% $index + 1 %></td>
                                    <td><a class="btn btn-primary" href="#" role="button" ng-click="showOrderProductsInfo(order.product_info)" data-toggle="modal" data-target="#edit_personal">Xem đơn hàng</a></td>
                                    <td><% order.price | currency:VND:0 | commaToDot | removeUSCurrency %> VNĐ</td>
                                    <td><% formatDate(order.created_at) | date: 'dd/MM/yyyy hh:mm' %></td>
                                    <td><% formatDate(order.updated_at) | date: 'dd/MM/yyyy hh:mm' %></td>
                                </tr>
                                <tr ng-show="completeOrdersMessage == 'No item found'">
                                    <td colspan="6">Bạn chưa có đơn hàng nào!</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="title_mid">
                            <h3><i class="fa fa-file-text-o"></i> Sản phẩm yêu thích</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td>STT</td>
                                    <td>Sản phẩm</td>
                                    <td>Tên sản phẩm</td>
                                    <td>Nồng độ cồn</td>
                                    <td>Nhà sản xuất</td>
                                    <td>Xuất xứ</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="likeproduct in showlikeproduct" ng-show="notCompleteOrdersMessage == 'Success'">
                                    <td><% $index + 1 %></td>
                                    <td><a class="btn btn-primary" href="{{ url('/san-pham/chi-tiet') }}/<% likeproduct.slug %>" role="button"  target="_self">Xem chi tiết</a></td>
                                    <!-- <td><a class="btn btn-primary" href="#" role="button" ng-click="showProductLike(likeproduct)" data-toggle="modal" data-target="#edit_personal">Xem chi tiết</a></td> -->
                                    <td><% likeproduct.name %></td>
                                    <td><% likeproduct.concentrations %></td>
                                    <td><% likeproduct.producer %></td>
                                    <td><% likeproduct.origin_title %></td>
                                </tr>
                                <tr ng-show="notCompleteOrdersMessage == 'No item found'">
                                    <td colspan="6">Bạn chưa có đơn hàng nào!</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- InstanceEndEditable -->
    </section>


    <script src="{{ asset ("public/frontend/app/controllers/customer.js") }}"></script>
    <script src="{{ asset ("public/frontend/app/controllers/modal.js") }}"></script>
@endsection