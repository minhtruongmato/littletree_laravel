@extends('admin.blog.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-4">
                        <a class="btn btn-primary" href="{{ route('blog.create', ['type' => 'advise']) }}">Thêm mới tư vấn</a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6"></div>
                </div>
                <form method="POST" action="{{ route('blog.search') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="type" value="advise" />
                    @component('admin.layouts.search', ['title' => 'Tìm kiếm'])
                        @component('admin.blog.search-panel.two-cols-search-row', ['items' => ['Title'],
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
                                    <th width="30%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Bài viết</th>
                                    <th width="20%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Slug</th>
                                    <th width="20%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Danh mục cha</th>
                                    <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($blog as $item)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ $item->title }}</td>
                                        <td class="sorting_1">{{ $item->slug }}</td>
                                        <td class="sorting_1">{{ $item->sub }}</td>

                                        <td>
                                            <form class="row" method="POST" action="{{ route('blog.destroy', ['id' => $item->id]) }}" onsubmit = "return confirm('Chắc chắn xoá?')">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <!-- <a href="{{ route('blog.show', ['id' => $item->id]) }}" class="btn btn-primary col-sm-3 col-xs-5 btn-margin">
                                                Chi tiết
                                                </a> -->
                                                <button class="btn btn-primary collapsed col-sm-3 col-xs-5 btn-margin" type="button" data-toggle="collapse" href="#{{ $item->id }}" aria-expanded="true" aria-controls="messageContent">Chi tiết</button>
                                                <a href="{{ route('blog.edit', ['id' => $item->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
                                                    Sửa
                                                </a>
                                                <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">
                                                    Xoá
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                      <td colspan="7" class="no_border">
                                          <div class="collapse" id="{{ $item->id }}">
                                            <div clas="row">
                                                <div class="col-md-5">
                                                    {{ HTML::image('storage/app/'.$item->image, '', array('width' => 100)) }}
                                                  <br>
                                                  <strong>Tiêu đề: </strong> {!! $item->title !!}
                                                  <br>
                                                  <strong>Danh mục cha: </strong> {{ $item->sub }}
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
                                @if(count($blog) > 0)
                                    <tfoot>
                                    <tr>
                                        <th width="10%" rowspan="1" colspan="1">Bài viết</th>
                                        <th width="10%" rowspan="1" colspan="1">Slug</th>
                                        <th width="10%" rowspan="1" colspan="1">Danh mục cha</th>
                                        <th rowspan="1" colspan="2">Hành động</th>
                                    </tr>
                                    </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Hiển thị {{count($blog)}} bài viết</div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                {{ $blog->links() }}
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