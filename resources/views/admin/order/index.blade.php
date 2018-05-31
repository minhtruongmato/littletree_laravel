@extends('admin.order.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6"></div>
                </div>
                <a href="{{ route('export.pending') }}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Xuất Excel</a>
                <form method="POST" action="{{ route('order.search') }}">
                {{ csrf_field() }}
                @component('admin.layouts.search', ['title' => 'Tìm kiếm'])
                @component('admin.order.search-panel.two-cols-search-row', ['items' => ['unique_code'],
                'oldVals' => [isset($searchingVals) ? $searchingVals['unique_code'] : '']])
                @endcomponent
                <br>
                @endcomponent
                </form>
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                <tr role="row">
                                    <th width="20%" class="" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Tên khách hàng</th>
                                    <th width="10%" class="" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Mã đơn hàng</th>
                                    <th width="10%" class="" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">T/g đặt hàng</th>
                                    <th width="10%" class="" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">T/g cập nhật</th>
                                    <th width="10%" class=" hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Tổng giá trị</th>
                                    <th width="10%" class=" hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Chi tiết</th>
                                    <th width="10%" class=" hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Trạng thái</th>
                                    <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orders as $item)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ $item->customer_name }}</td>
                                        <td class="sorting_1">{{ $item->unique_code }}</td>
                                        <td class="sorting_1">{{ $item->created_at }}</td>
                                        <td class="sorting_1">{{ $item->updated_at }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td><button class="btn btn-primary" type="button" data-toggle="collapse" href="#{{ $item->id }}" aria-expanded="false" aria-controls="messageContent">
                                                Chi tiết
                                            </button></td>
                                        {{ $status = '' }}
                                        @if($item->status == 0)
                                            <td class="sorting_1" style="color:blue">Đơn hàng mới</td>
                                        @elseif($item->status == 1)
                                            <td class="sorting_1" style="color:yellowgreen">Đang thực hiện</td>
                                        @elseif($item->status == 99)
                                            <td class="sorting_1" style="color:red">Đã bỏ qua</td>
                                        @else
                                            <td class="sorting_1" style="color:green">Đã hoàn thành</td>
                                        @endif
                                        <td>
                                            @if($item->status == 0)
                                                <a href="{{ route('order.approve', ['id' => $item->id]) }}" class="btn btn-warning col-sm-5 col-xs-5 btn-margin" onclick = "return confirm('Xác nhận đơn hàng (kho sẽ tự động giảm đi số lượng tương ứng trong đơn hàng)?')">
                                                    Xác nhận
                                                </a>
                                                <a href="{{ route('order.cancel', ['id' => $item->id]) }}" class="btn btn-danger col-sm-5 col-xs-5 btn-margin" onclick = "return confirm('Bỏ qua đơn hàng?')">
                                                    Bỏ qua đơn hàng
                                                </a>
                                            @elseif($item->status == 1)
                                                <a href="{{ route('order.complete', ['id' => $item->id]) }}" class="btn btn-success col-sm-5 col-xs-5 btn-margin" onclick = "return confirm('Đóng và đánh dấu đơn hàng đã hoàn thành?')">
                                                    Đóng đơn hàng
                                                </a>
                                                <a href="{{ route('order.rollback', ['id' => $item->id]) }}" class="btn btn-danger col-sm-5 col-xs-5 btn-margin" onclick = "return confirm('Huỷ đơn hàng (kho sẽ tự hoàn lại số lượng sản phẩm đơn hàng đã trừ khi xác nhận)?')">
                                                    Huỷ đơn hàng
                                                </a>
                                            @else
                                                <strong>N/A</strong>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" class="no_border">
                                            <div class="collapse" id="{{ $item->id }}">
                                                <div clas="row">
                                                    <div class="col-md-6">
                                                        <strong>Khách hàng:</strong> {{ $item->customer_name }}
                                                        <br>
                                                        <strong>Số điện thoại:</strong> {{ $item->customer_phone }}
                                                        <br>
                                                        <strong>Email:</strong> {{ $item->customer_email }}
                                                        <br>
                                                        <strong>Địa chỉ giao hàng:</strong> {{ $item->customer_address . ', ' . $item->customer_district . ', ' . $item->customer_city}}
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h4>Thông tin đơn hàng:</h4>
                                                        <table style="width: 100%">
                                                            <tr>
                                                                <td style="width: 50%;"><strong>Tên sản phẩm</strong></td>
                                                                <td style="width: 25%;"><strong>Số lượng</strong></td>
                                                                <td style="width: 25%;"><strong>Giá trị</strong></td>
                                                            </tr>
                                                            @foreach($item->product_info as $key => $value)
                                                                <tr>
                                                                    <td>{{ $value->product_name }}</td>
                                                                    <td>{{ $value->product_quantity }}</td>
                                                                    <td>{{ $value->product_total_cost }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                        <hr>
                                                        <strong>Tổng giá tiền: {{ $item->price }}</strong>
                                                    </div>
                                                </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                @if(count($orders) > 0)
                                    <tfoot>
                                    <tr>
                                        <th width="20%" rowspan="1" colspan="1">Tên khách hàng</th>
                                        <th width="10%" rowspan="1" colspan="1">Mã đơn hàng</th>
                                        <th width="10%" rowspan="1" colspan="1">Thời gian đặt hàng</th>
                                        <th width="10%" rowspan="1" colspan="1">Cập nhật lần cuối</th>
                                        <th class="hidden-xs" width="10%" rowspan="1" colspan="1">Tổng giá trị</th>
                                        <th class="hidden-xs" width="10%" rowspan="1" colspan="1">Chi tiết</th>
                                        <th class="hidden-xs" width="10%" rowspan="1" colspan="1">Trạng thái</th>
                                        <th rowspan="1" colspan="2">Hành động</th>
                                    </tr>
                                    </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Hiển thị {{count($orders)}} sản phẩm</div>
                        </div>
                        {{--<div class="col-sm-7">--}}
                        {{--<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">--}}
                        {{--{{ $orders->links() }}--}}
                        {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
    <!-- /.content -->
    </div>
@endsection