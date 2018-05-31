<div modal="showModal" close="cancel()" ng-controller="MainController">
    {{--<div class="modal-dialog modal-lg" role="document">--}}
        {{--<div class="modal-content">--}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" ng-click="cancel()">&times;</span></button>
                <h4 class="modal-title" id="product_quickView_Label">Xem nhanh sản phẩm</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="preview col-md-5 col-sm-5 col-xs-12">
                        <a class="preview">
                            <img src="http://localhost/mmm/storage/app/<% dataModal.image %>" class="w-100" alt="preview">
                        </a>
                        {{--<ul class="list-inline other">--}}
                        {{--<li>--}}
                        {{--<img class="w-thumbnail" src="img/SP1.jpg" alt="preview">--}}
                        {{--</li>--}}
                        {{--<li>--}}
                        {{--<img class="w-thumbnail" src="img/SP1.jpg" alt="preview">--}}
                        {{--</li>--}}
                        {{--</ul>--}}
                    </div>
                    <div class="infomation col-lg-7 col-md-7 col-sm-7 col-xs-12">
                        <h2><% dataModal.name %></h2>

                        <h3 class="price"><% dataModal.price | currency:VND:0 | commaToDot | removeUSCurrency  %> vnđ</h3>
                        <h4 class="quantity" ng-if="dataModal.quantity != 0">Trạng thái: còn hàng</h4>
                        <h4 class="quantity" ng-if="dataModal.quantity == 0">Trạng thái: hết hàng</h4>

                        <div class="info">
                            <table class="table">
                                <tr>
                                    <td>Công dụng</td>
                                    <td><% dataModal.effect %></td>
                                </tr>
                                <tr>
                                    <td>Trọng lượng</td>
                                    <td><% dataModal.weight %></td>
                                </tr>
                                <tr>
                                    <td>Nhà sản xuất</td>
                                    <td><% dataModal.producer %></td>
                                </tr>
                            </table>

                            <form class="form-inline">
                                {{--<div class="form-group">--}}
                                    {{--<label for="inputQuanlity_quickView">Số lượng</label>--}}
                                    {{--<input type="number" class="form-control" id="inputQuanlity_quickView">--}}
                                {{--</div>--}}
                                <a href="#" class="product_addtoCart" data-toggle="modal" data-target="#product_quickview" title="Thêm vào giỏ hàng" ng-click="addToCart(dataModal.id)">Thêm vào giỏ hàng</a>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-heart-o"></i></button>
                                <br><br>
                                <a class="link-primary" href="{{ url('san-pham/chi-tiet') }}/<% dataModal.slug %>" target="_self">Xem chi tiết</a>
                                <br>
                                <br>
                                Chia sẻ: <a href="#" target="_blank" id="link-facebook"><i class="fa fa-2x fa-facebook-official"></i></a> <a href="#" target="_blank" id="link-google-plus"><i class="fa fa-2x fa-google-plus-official"></i></a>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" ng-click="ok()">Đóng</button>
            </div>
        {{--</div>--}}
    {{--</div>--}}
</div>