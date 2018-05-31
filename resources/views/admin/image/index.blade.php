@extends('admin.image.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-header">
          <div class="row">
            <div class="col-sm-12">
                <a class="btn btn-primary" href="#">Thêm mới ảnh</a>
                <br><br>
                <form class="form-horizontal" role="form" method="POST" action="{{ route('image.store', ['id' => $library_id]) }}" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="avatar" class="col-md-2 control-label" style="text-align: left;">Chọn hình ảnh</label>
                        <div class="col-md-8" style="padding-top: 6px;margin-left: -60px;">
                            <input type="file" id="image" name="image" required>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary" style="margin-left: 80px;">Thêm</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="">
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending" style="text-align: center;">Hình ảnh</th>
                <th width="20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending" style="text-align: center; padding: 8px;">Hành động</th>
              </tr>
            </thead>
            <tbody>
              @foreach($images as $value)
                <tr role="row" class="odd">
                  <td>{{ HTML::image('storage/app/library/'.$library->slug.'/'.$value->image,'', array('width' => 150)) }}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('image.destroy', ['id' => $value->id]) }}" onsubmit = "return confirm('Chắc chắn xoá?')">
                          <input type="hidden" name="_method" value="DELETE">
                          <input type="hidden" name="_token" value="">
                          
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <button type="submit" class="btn btn-danger col-md-6 col-md-offset-3">
                            Xoá
                          </button>
                      </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Hiển thị  sản phẩm</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
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