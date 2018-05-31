@extends('admin.comment.base')
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
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="70%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Tên bài viết</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Hành động</th>
              </tr>
            </thead>
            <tbody>
              @foreach($comments as $value)
                <tr role="row" class="odd">
                  <td>{{ $value->title }}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('comment.deleteBlogComment', ['id' => $value->id, 'blog_id' => $value->blog_id]) }}" onsubmit = "return confirm('Chắc chắn xoá?')">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="btn btn-primary collapsed col-sm-2 col-xs-5 btn-margin" type="button" data-toggle="collapse" href="#{{ $value->id }}" aria-expanded="true" aria-controls="messageContent">Chi tiết</button>
                         <button type="submit" class="btn btn-danger col-sm-2 col-xs-5 btn-margin">
                          Xoá
                        </button>
                    </form>
                  </td>
                </tr>
                <tr>
                  <td colspan="7" class="no_border">
                      <div class="collapse" id="{{ $value->id }}">
                        <div clas="row">
                            <div class="col-md-5">
                              <strong>Tên người bình luận:</strong> {{ $value->author }}
                              <br>
                              <strong>Email người bình luận:</strong> {{ $value->email }}
                              <br>
                              <strong>Thời gian bình luận:</strong> {{ $value->created_at }}
                              <br>
                            </div>
                            <div class="col-md-7">
                                <table style="width: 100%">
                                    <tr>
                                        <td style="width: 50%;"><strong>Nội dung</strong></td>
                                    </tr>
                                    <tr>
                                        <td>{{ $value->content }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                      </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width="10%" rowspan="1" colspan="1">Tên bài viết</th>
                <th rowspan="1" colspan="2">Hành động</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to  entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $comments->links() }}
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