<div modal="showModal" close="cancel()" ng-controller="MainController">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="edit_personal_Label">Thông tin đơn hàng</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>STT</td>
                        <td>Tên sản phẩm</td>
                        <td>Số lượng</td>
                        <td>Giá thành</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="product in dataModal">
                        <td><% $index + 1 %></td>
                        <td><% product.product_name %></td>
                        <td><% product.product_quantity %></td>
                        <td><% product.product_total_cost | currency:VND:0 | commaToDot | removeUSCurrency %> VNĐ</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
