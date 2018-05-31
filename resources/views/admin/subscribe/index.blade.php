@extends('admin.subscribe.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box ">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-4">
          <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token-send-all">
          <a class="btn btn-primary" id="sendAll" href="{{ route('subscrie.sendAll') }}">Gửi tất cả</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending"><input type="checkbox" class="check-all" id="check-all" /> Check All</th>
                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Email</th>
                <th class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Gửi Email</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Hành động</th>
              </tr>
            </thead>
            <tbody>
              @if($subscribes)
              @foreach($subscribes as $value)
                <tr role="row" class="odd">
                  <td class="sorting_1"><input type="checkbox" id="{{ $value->id }}" class="checkbox" name="checkbox[{{ $value->id }}]" /></td>
                  <td class="sorting_1">{{ $value->email }}</td>
                  <td class="hidden-xs">
                    <a href="" class="btn btn-success btn-send-mail" data-email="{{ $value->email }}">Gửi</a>
                  </td>
                  <td>
                    <form class="row" method="POST" action="{{ route('subscribe.destroy', ['id' => $value->id]) }}" onsubmit = "return confirm('Chắc chắn xoá?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                         <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">
                          Xoá
                        </button>
                    </form>
                  </td>
                </tr>
              @endforeach
              @else
              <tr>
                <td>Chưa có Email đăng ký theo dõi</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite"></div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $subscribes->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="encypted_ppbtn" style="display: none">
    <div class="modal fade" id="myModal" role="dialog" style="display: block; opacity: 0.5;"><div class="modal-dialog" style="color:#fff; text-align:center; padding-top:300px;"><i class="fa fa-2x fa-spinner fa-spin" aria-hidden="true"></i></div></div>
  </div>
  <!-- /.box-body -->
</div>
    </section>
    <!-- /.content -->
  </div>

<script src="{{ asset ("public/admin/js/subscribe.js") }}" type="text/javascript"></script>
@endsection