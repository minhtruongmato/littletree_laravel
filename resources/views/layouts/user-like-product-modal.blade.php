<link href="{{ asset("public/frontend/css/flexslider.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("public/frontend/css/store.css")}}" rel="stylesheet" type="text/css" />
    <section class="main_content" modal="showModal" close="cancel()" ng-controller="MainController" style = "margin-top:10px;">
        <!-- InstanceBeginEditable name="content" -->
                <div class="product_dataModal container-fluid">
                    <div class="row">
                        <div class="infomation col-md-12 col-sm-12 col-xs-12">
                            <h2 class="productName"><% dataModal.name %></h2>

                            <h2 class="productPrice">
                                <span class="price"><% dataModal.price | currency:VND:0 | commaToDot | removeUSCurrency  %> vnđ</span>
                            </h2>
                            <jk-rating-stars rating="secondRate" read-only="readOnly" ></jk-rating-stars> <strong>Tổng số đánh giá:  <span style="color: blue"> <% count %></span></strong>

                            <div class="info">
                                <table class="table">
                                    <tr>
                                        <td>Nồng độ cồn</td>
                                        <td><% dataModal.concentrations %></td>
                                    </tr>
                                    <tr>
                                        <td>Dung tích</td>
                                        <td><% dataModal.capacity %></td>
                                    </tr>
                                    <tr>
                                        <td>Nguyên liệu</td>
                                        <td><% dataModal.material %></td>
                                    </tr>
                                    <tr>
                                        <td>Niên vụ</td>
                                        <td><% dataModal.year %></td>
                                    </tr>
                                    <tr>
                                        <td>Nhà sản xuất</td>
                                        <td><% dataModal.producer %></td>
                                    </tr>
                                    <tr>
                                        <td>Thể tích</td>
                                        <td><% dataModal.volume %></td>
                                    </tr>
                                    <tr>
                                        <td>Xuất xứ</td>
                                        <td><% dataModal.origin_title %></td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            <p ng-bind-html="$sce.trustAsHtml(dataModal.description)"></p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            Chia sẻ qua <a href="javascript:void(0);" class="btn btn-primary" role="button"><i class="fa fa-facebook-f" aria-hidden="true"></i> </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2">
                                            <button class="btn btn-primary" type="submit"  ng-click="addToCart(dataModal.id)">Thêm vào giỏ hàng</button>
                                            <a href="javascript:void(0);" class="btn btn-primary" role="button" ng-click="addToTasting(dataModal.id)">Đăng ký thử ruọu</a>
                                        </td>
                                    </tr>

                                </table>

                            </div>
                        </div>
                    </div>


                </div>
        <!-- InstanceEndEditable -->
    </section>
    <script src="{{ asset ("public/frontend/app/controllers/dataModal-product.js") }}"></script>
    <script src="{{ asset ("public/frontend/app/controllers/modal.js") }}"></script>
    <script src="{{ asset ("public/frontend/js/jquery.flexslider.js") }}"></script>