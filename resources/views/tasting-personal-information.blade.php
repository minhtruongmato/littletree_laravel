@extends('layouts.frontend-template')
@section('content')
    <link href="{{ asset("public/frontend/css/cart.css")}}" rel="stylesheet" type="text/css" />

    <section class="main_content" ng-controller="TastingController">
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
                                {{-- <% guestInfo.inputName.$submitted || guestInfo.inputName.$valid %> --}}
                                <span class="error" style="color:red" ng-show="guestInfo.inputName.$error.required">
                                    Bắt buộc nhập!
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email (*)</label>
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
                            <label for="inputPhoneNumer">Điện thoại (*)</label>
                            <input type="text" class="form-control" name="inputPhoneNumer" placeholder="VD: 0912345678" ng-model="customerInfo.phone" numbers-only="" required >
                            <span class="error" style="color:red" ng-show="guestInfo.inputPhoneNumer.$error.required">
                                Bắt buộc và chỉ cho phép nhập số!
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="inputAmountOfPeople">Số người thử rượu (*)</label>
                            <input type="number" class="form-control" name="inputAmountOfPeople" ng-model="customerInfo.people" min="1">
                            <div role="alert">
                                <span class="error" style="color:red" ng-show="guestInfo.inputAmountOfPeople.$error.min">
                                    Số người thử rượu ít nhất là một
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputStore">Thử rượu tại cửa hàng</label>
                            <br>
                            <input type="checkbox" name="inputStore" value="1" ng-model="customerInfo.store" id="inputStore"><span id="address" style="display: none;">&nbsp&nbsp Địa chỉ cửa hàng</span>
                        </div>

                        <div class="form-group" id="inputAdress">
                            <label for="inputAdress">Địa chỉ thử rượu</label>
                            <input type="text" class="form-control bnt-disabled" name="inputAdress" placeholder="Số nhà (ngõ / ngách), Phố / Phường" ng-model="customerInfo.address">
                            <div role="alert">
                                <span class="error" style="color:red" ng-show="(customerInfo.inputAdress.$dirty || submitted) && customerInfo.inputAdress.$error.required">
                                    Bắt buộc nhập!
                                </span>
                            </div>
                            <br>
                            <input type="text" class="form-control bnt-disabled" name="inputDistrict" placeholder="Quận" ng-model="customerInfo.district">
                            <div role="alert">
                                <span class="error" style="color:red" ng-show="(customerInfo.inputDistrict.$dirty || submitted) && customerInfo.inputDistrict.$error.required">
                                    Bắt buộc nhập!
                                </span>
                            </div>
                            <br>
                            <input type="text" class="form-control bnt-disabled" name="inputCity" placeholder="Thành phố" ng-model="customerInfo.city">
                            <div role="alert">
                                <span class="error" style="color:red" ng-show="(customerInfo.inputCity.$dirty || submitted) && customerInfo.inputCity.$error.required">
                                    Bắt buộc nhập!
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAdress">Thời gian thử rượu (*): </label><br>
                            <strong>Ngày</strong>
                            <input type="text" class="form-control" name="inputTime" placeholder="" ng-model="customerInfo.time" id="dob">
                            <div role="alert">
                                <span class="error" style="color:red" ng-show="guestInfo.inputTime.$error.required">
                                    Bắt buộc nhập!
                                </span>
                            </div>
                            <br>
                            <strong>Giờ</strong>
                            <select class="form-control" name="inputHour" ng-model="customerInfo.hour">
                                @for ($i = 0; $i <= 23; $i++)
                                <option value="{{ $i }}" >{{ $i }} giờ</option>
                                @endfor
                            </select>
                            <br>
                            <strong>Phút</strong>
                            <select class="form-control" name="inputMinute" ng-model="customerInfo.minute">
                                @for ($i = 0; $i <= 59; $i++)
                                <option value="{{ $i }}" >{{ $i }} phút</option>
                                @endfor
                            </select>
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
                            <label for="inputNote">Ghi chú</label>
                            <textarea class="form-control" id="inputNote" rows="3" ng-model="customerInfo.content" placeholder="Nội dung ghi chú"></textarea>
                        </div>

                        <br>
                        <br>
                        <a class="btn btn-default pull-left" href="{{ url('xem-gio-hang') }}" role="button" target="_self">
                            <i class="fa fa-arrow-left"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-primary pull-right" name="btn_tasting" ng-disabled="guestInfo.inputName.$invalid || guestInfo.inputEmail.$invalid || guestInfo.inputPhoneNumer.$invalid || guestInfo.inputAmountOfPeople.$invalid" >
                            Tiếp tục đăng ký thử rượu <i class="fa fa-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- InstanceEndEditable -->
    </section>
    <script src="{{ asset ("public/frontend/app/controllers/tasting.js") }}"></script>
    <script>
        $('#dob').datepicker({
            // autoclose: true,
            format: 'yyyy-mm-dd'
        });

        $('#inputStore').each(function(){
            if($(this).prop("checked") == true){
                $(".bnt-disabled").prop('disabled', true);
            }
            else if($(this).prop("checked") == false){
                $(".bnt-disabled").prop('disabled', false);
            }
        })

        $('#inputStore').click(function(){
            if($(this).prop("checked") == true){
                $(".bnt-disabled").prop('disabled', true);
                $('#address').fadeIn();
            }
            else if($(this).prop("checked") == false){
                $(".bnt-disabled").prop('disabled', false);
                $('#address').fadeOut();
            }
        })
</script>
@endsection