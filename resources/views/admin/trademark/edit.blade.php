@extends('admin.trademark.base')

@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Cập nhật thương hiệu</div>
                    <div class="panel-body">
                        <p style="color:orange">TIP: Nếu trong Thương hiệu đang chứa Danh mục, không thể bỏ chọn Dùng thương hiệu</p>
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('trademark.update', ['id' => $trademark->id]) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type" class="col-md-2 control-label">Loại sản phẩm</label>

                                <div class="col-md-8">
                                    <select name="type_id"  class="form-control type" data-page="{{ $trademark->kind_id }}" autofocus>
                                        @foreach($type as $value)
                                            <option value="{{ $value->id }}" {{ ($value->id == $trademark->type_id)? 'selected' : '' }} >{{ $value->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type" class="col-md-2 control-label">Loại sản phẩm</label>

                                <div class="col-md-8">
                                    <select name="kind_id"  class="form-control kind">
                                        <!-- @foreach($kind as $value)
                                            <option value="{{ $value->id }}" {{ ($value->id == $trademark->kind_id)? 'selected' : '' }} >{{ $value->title }}</option>
                                        @endforeach -->
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-2 control-label">Tên thương hiệu</label>

                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $trademark->name }}" autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-2 control-label">Slug</label>

                                <div class="col-md-8">
                                    <input id="slug" type="text" class="form-control" name="slug" value="{{ $trademark->slug }}" required readonly>

                                    @if ($errors->has('slug'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" name="is_active" value="0">
                            <div class="form-group{{ $errors->has('is_active') ? ' has-error' : '' }}">
                                <label for="is_active" class="col-md-2 control-label">Dùng thương hiệu?</label>

                                <div class="col-md-8">
                                    <input id="is_active" type="checkbox" class="minimal" name="is_active" value="1"
                                        @if($trademark->is_active == 1)
                                            checked
                                        @endif
                                    >

                                    @if(isset($error_message))
                                        <p style="color: red"><strong>{{ $error_message }}</strong></p>
                                    @endif
                                    @if ($errors->has('is_active'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('is_active') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="avatar" class="col-md-2 control-label" >Hình ảnh</label>
                                <div class="col-md-8">
                                    <input type="file" id="image" name="image">
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="avatar" class="col-md-2 control-label" >Hình ảnh hiện tại</label>
                                <div class="col-md-8">
                                    {{ HTML::image('storage/app/' . $trademark->image) }}
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-2 control-label">Giới thiệu ngắn</label>

                                <div class="col-md-8">
                                    <textarea id="description" rows="10" class="form-control" name="description" autofocus>{{ $trademark->description }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        OK
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
