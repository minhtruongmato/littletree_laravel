@extends('admin.product.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('product.create') }}">Thêm mới sản phẩm</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('product.search') }}">
         {{ csrf_field() }}
         @component('admin.layouts.search', ['title' => 'Tìm kiếm'])
          @component('admin.product.search-panel.two-cols-search-row', ['items' => ['title'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['title'] : '']])
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
                <th width="23%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Tên sản phẩm</th>
                <th width="23%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Slug</th>
                <th width="23%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Danh mục cha</th>
                <th  width="30%" tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Hành động</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($products as $item)
                <tr role="row" class="odd">
                  <td class="hidden-xs">{{$item->title}}</td>
                  <td class="hidden-xs">{{$item->slug}}</td>
                  <td class="hidden-xs">{!! $item->productCategory['title'] !!}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('product.destroy', ['id' => $item->id]) }}" onsubmit = "return confirm('Chắc chắn xoá?')">
                        <button class="btn btn-primary collapsed col-sm-2 col-xs-5 btn-margin" type="button" data-toggle="collapse" href="#{{ $item->id }}" aria-expanded="true" aria-controls="messageContent">Chi tiết</button>

                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('product.edit', ['id' => $item->id]) }}" class="btn btn-warning col-sm-2 col-xs-5 btn-margin">
                        Sửa
                        </a>
                         <button type="submit" class="btn btn-danger col-sm-2 col-xs-5 btn-margin">
                          Xoá
                        </button>
                    </form>
                  </td>
              </tr>
              <tr>
                <td colspan="7" class="no_border">
                    <div class="collapse" id="{{ $item->id }}">
                      <div clas="row">
                          <div class="col-md-4">
                              <?php $image = json_decode($item->image);?>
                              @if(is_array($image) == true)
                                @foreach ($image as $val)
                                  {{ HTML::image('storage/app/products/'.$item->slug.'/'.$val, '', array('width' => 100)) }}
                                @endforeach
                              @else
                                {{ HTML::image('storage/app/'.$item->image, '', array('width' => 100)) }}
                              @endif
                            <br>
                            <strong>Tên sản phẩm: </strong> {!! $item->title !!}
                            <br>

                            <strong>Danh mục cha: </strong> {!! $item->productCategory['title'] !!}
                            <br>
                            <strong>Giá cho sản phẩm nhỏ: </strong> {!! $item->price_min !!}
                            <br>
                            <strong>Giá cho sản phẩm trung bình: </strong> {!! $item->price_mid !!}
                            <br>
                            <strong>Giá cho sản phẩm lớn: </strong> {!! $item->price_max !!}
                          </div>
                          <div class="col-md-8">
                              <table style="width: 100%">
                                  <tr>
                                      <td style="width: 35%;"><strong>Giới thiệu</strong></td>
                                      <td style="width: 5%;"></td>
                                      <td style="width: 60%;"><strong>Mô tả</strong></td>
                                  </tr>
                                  <tr>
                                      <td>{!! $item->description !!}</td>
                                      <td></td>
                                      <td style="padding:0px 5px;">{!! $item->content !!}</td>
                                  </tr>
                              </table>
                          </div>
                      </div>
                    </div>
                </td>
              </tr>
            @endforeach
            </tbody>
            @if(count($products) > 0)
            <tfoot>
              <tr>
                <th width="23%" rowspan="1" colspan="1">Tên sản phẩm</th>
                <th width="23%" rowspan="1" colspan="1">Slug</th>
                <th width="23%" rowspan="1" colspan="1">Danh mục cha</th>
                <th rowspan="1" colspan="2">Hành động</th>
              </tr>
            </tfoot>
            @endif
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Hiển thị {{count($products)}} sản phẩm</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $products->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
    </section>
    <!-- /.content -->
  </div>
@endsection