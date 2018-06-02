@extends('admin.about.base')
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
                                    <th width="35%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Title</th>
                                    <th width="35%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Slug</th>
                                    <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($about as $item)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ $item->title }}</td>
                                        <td class="sorting_1">{{ $item->slug }}</td>

                                        <td>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button class="btn btn-primary collapsed col-sm-3 col-xs-5 btn-margin" type="button" data-toggle="collapse" href="#{{ $item->id }}" aria-expanded="true" aria-controls="messageContent">Chi tiết</button>
                                                <a href="{{ route('about.edit', ['id' => $item->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
                                                    Sửa
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                      <td colspan="7" class="no_border">
                                          <div class="collapse" id="{{ $item->id }}">
                                            <div clas="row">
                                                <div class="col-md-5">
                                                  <strong>Tiêu đề: </strong> {!! $item->title !!}
                                                  <br>
                                                  {{ HTML::image('storage/app/'.$item->image, '', array('width' => 100)) }}
                                                </div>
                                                <div class="col-md-7">
                                                    <table style="width: 100%">
                                                        <tr>
                                                            <td style="width: 50%;"><strong>Mô tả</strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td>{!! $item->content !!}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                          </div>
                                      </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                @if(count($about) > 0)
                                    <tfoot>
                                    <tr>
                                        <th width="10%" rowspan="1" colspan="1">Title</th>
                                        <th width="10%" rowspan="1" colspan="1">Slug</th>
                                        <th rowspan="1" colspan="2">Hành động</th>
                                    </tr>
                                    </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Hiển thị {{count($about)}} bài viết</div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                {{ $about->links() }}
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