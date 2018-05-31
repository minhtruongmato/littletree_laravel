@extends('layouts.frontend-template')
@section('content')
    <link href="{{ asset("public/frontend/css/cart.css")}}" rel="stylesheet" type="text/css" />

    <section class="main_content" ng-controller="CartController">
        <!-- InstanceBeginEditable name="content" -->
        <div class="container">
            <div class="col-md-8 col-sm-12 col-md-offset-2">
                <div class="row">
                    <h3><strong>Thông tin khách hàng</strong></h3>
                    <form name="guestInfo" ng-submit="submitForm()">
                        @if (Auth::guest())
                            <input type="hidden" name="hidden" value="0" />
                        @else
                            <input type="hidden" name="hidden" value="{{ Auth::user()->id }}" />
                        @endif
                        <div class="form-group">
                            <label for="inputFirstName">Họ tên (*)</label>
                            <input type="text" class="form-control" name="inputName" placeholder="VD: Nguyễn" ng-model="customerInfo.name" required>
                            <div role="alert">
                                <span class="error" style="color:red" ng-show="guestInfo.inputName.$error.required">
                                    Bắt buộc nhập!
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="email" class="form-control" name="inputEmail" placeholder="Email" ng-model="customerInfo.email" required>
                            <div role="alert">
                                <span class="error" style="color:red" ng-show="guestInfo.inputEmail.$error.required">
                                    Bắt buộc nhập!
                                </span>
                                <span class="error" style="color:red" ng-show="guestInfo.inputEmail.$error.email">
                                    Sai định dạng email!
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPhoneNumer">Điện thoại</label>
                            <input type="text" class="form-control" name="inputPhoneNumer" placeholder="VD: 0912345678" ng-model="customerInfo.phone" numbers-only="" required>
                            <span class="error" style="color:red" ng-show="guestInfo.inputPhoneNumer.$error.required">
                                Bắt buộc và chỉ cho phép nhập số!
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="inputAdress">Địa chỉ giao hàng</label>
                            <input type="text" class="form-control" name="inputAdress" placeholder="Số nhà (ngõ / ngách), Phố / Phường" ng-model="customerInfo.address" required>
                            <div role="alert">
                                <span class="error" style="color:red" ng-show="(customerInfo.inputAdress.$dirty || submitted) && customerInfo.inputAdress.$error.required">
                                    Bắt buộc nhập!
                                </span>
                            </div>
                            <br>
                            <input type="text" class="form-control" name="inputDistrict" placeholder="Quận" ng-model="customerInfo.district" required>
                            <div role="alert">
                                <span class="error" style="color:red" ng-show="(customerInfo.inputDistrict.$dirty || submitted) && customerInfo.inputDistrict.$error.required">
                                    Bắt buộc nhập!
                                </span>
                            </div>
                            <br>
                            <input type="text" class="form-control" name="inputCity" placeholder="Thành phố" ng-model="customerInfo.city" required>
                            <div role="alert">
                                <span class="error" style="color:red" ng-show="(customerInfo.inputCity.$dirty || submitted) && customerInfo.inputCity.$error.required">
                                    Bắt buộc nhập!
                                </span>
                            </div>
                        </div>
                        <small>Những thông tin (*) là bắt buộc</small>
                        <br>
                        <br>
                        @if (!Auth::guest())
                            <button type="button" class="btn btn-primary" ng-click="getLoggedInfo()">
                                <i class="fa fa-user"></i> Sử dụng thông tin tài khoản đã đăng ký
                            </button>
                        @endif
                        <div class="form-group">
                            <h3><strong>Hình thức thành toán</strong></h3>
                            <table class="table">
                                <tr>
                                    <td><input type="radio" ng-model="customerInfo.paymentMethod" id="inlineRadio1" value="1" ng-required="!customerInfo.paymentMethod"></td>
                                    <td>Thanh toán khi giao hàng (COD)</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" ng-model="customerInfo.paymentMethod" id="inlineRadio2" value="2" ng-required="!customerInfo.paymentMethod"></td>
                                    <td>
                                        Chuyển khoản
                                        <br>
                                        <strong>Ngân hàng: VCB - Ngân hàng Vietcombank</strong>
                                        <br>
                                        Số tài khoản: 001.002.0030004
                                        <br>
                                        Tên tài khoản: Công ty Maymymy
                                        <br>
                                        Nội dung chuyển khoản: Họ tên + Mã đơn hàng
                                        <br><br>
                                        <strong>Ngân hàng: TEC - Ngân hàng Techcombank</strong>
                                        <br>
                                        Số tài khoản: 001.002.0030004
                                        <br>
                                        Tên tài khoản: Công ty Maymymy
                                        <br>
                                        Nội dung chuyển khoản: Họ tên + Mã đơn hàng
                                    </td>
                                    {{--<td ng-if="customerInfo.paymentMethod == 2">--}}
                                        {{--<label for="inputBankNumber">Chủ tài khoản (*)</label>--}}
                                        {{--<input type="text" class="form-control" name="inputBankAccountName" ng-model="customerInfo.bankAccountName" required>--}}
                                        {{--<label for="inputBankNumber">Số tài khoản (*)</label>--}}
                                        {{--<input type="text" class="form-control" name="inputBankNumber" ng-model="customerInfo.bankNumber" required>--}}
                                        {{--<label for="inputBankNumber">Ngân hàng (*)</label>--}}
                                        {{--<input type="text" class="form-control" name="inputBankName" ng-model="customerInfo.bankName" required>--}}
                                        {{--<label for="inputBankNumber">Chi nhánh (*)</label>--}}
                                        {{--<input type="text" class="form-control" name="inputBankBranch" ng-model="customerInfo.bankBranch" required>--}}
                                    {{--</td>--}}
                                </tr>
                                <!--<tr>
                                    <td><input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"></td>
                                    <td>Thẻ ATM nội địa</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option4"></td>
                                    <td>Thẻ ATM quốc tế</td>
                                </tr>-->
                            </table>
                        </div>
                        {{--<div class="form-group">--}}
                            {{--<input type="radio" name="payment-method" value="cod"> Thanh toán khi giao hàng (COD)<br>--}}
                            {{--<input type="radio" name="payment-method" value="bank"> Chuyển khoản<br>--}}
                        {{--</div>--}}

                        <div class="form-group">
                            <label for="inputNote">Ghi chú đơn hàng</label>
                            <textarea class="form-control" id="inputNote" rows="3" ng-model="customerInfo.content"></textarea>
                        </div>

                        <br>
                        <br>
                        <a class="btn btn-default pull-left" href="{{ url('xem-gio-hang') }}" role="button" target="_self">
                            <i class="fa fa-arrow-left"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-primary pull-right"  ng-disabled="guestInfo.inputName.$invalid || guestInfo.inputEmail.$invalid || guestInfo.inputPhoneNumer.$invalid" >
                            Tiếp tục mua hàng <i class="fa fa-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- InstanceEndEditable -->
    </section>
    <script src="{{ asset ("public/frontend/app/controllers/cart.js") }}"></script>
@endsection