<div modal="showModal" close="cancel()" ng-controller="MainController">
{{--<div class="modal fade" id="edit_personal" tabindex="-1" role="dialog" aria-labelledby="edit_personal_Label" ng-controller="MainController">--}}
    {{--<div class="modal-dialog modal-lg" role="document">--}}
        {{--<div class="modal-content">--}}
    <form name="guestInfo" ng-submit="submitPesonalForm()">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="edit_personal_Label">Thông tin cá nhân</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3>Thay đổi thông tin</h3>

                            <div class="form-group">
                                <label for="inputFirstName">Họ tên (*)</label>
                                <input type="text" class="form-control" name="inputName" placeholder="VD: Nguyễn" ng-model="dataModal.name" required>
                                <div role="alert">
                                        <span class="error" style="color:red" ng-show="(dataModal.inputName.$dirty || submitted) && dataModal.inputName.$error.required">
                                            Bắt buộc nhập!
                                        </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPhoneNumer">Điện thoại (*)</label>
                                <input type="text" class="form-control" name="inputPhoneNumer" placeholder="VD: 0912345678" ng-model="dataModal.phone" numbers-only="" required>
                                <span class="error" style="color:red" ng-show="((dataModal.inputPhoneNumer.$dirty || submitted) && dataModal.inputName.$dirty || submitted) && dataModal.inputPhoneNumer.$error.required">
                                        Bắt buộc và chỉ cho phép nhập số!
                                    </span>
                            </div>
                            <div class="form-group">
                                <label for="inputAdress">Địa chỉ giao hàng</label>
                                <input type="text" class="form-control" name="inputAdress" placeholder="Số nhà (ngõ / ngách), Phố / Phường" ng-model="dataModal.address">
                                <br>
                                <input type="text" class="form-control" name="inputDistrict" placeholder="Quận" ng-model="dataModal.district">
                                <br>
                                <input type="text" class="form-control" name="inputCity" placeholder="Thành phố" ng-model="dataModal.city">
                            </div>
                            <small>Những thông tin (*) là bắt buộc</small>
                            <br>
                            <br>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{--<button type="submit" class="btn btn-primary">Lưu thay đổi</button>--}}
                <input type="submit" class="btn btn-primary" value="Lưu thay đổi" ng-click="cancel()">
            </div>
    </form>
        {{--</div>--}}
    {{--</div>--}}
</div>
<script src="{{ asset ("public/frontend/app/controllers/customer.js") }}"></script>