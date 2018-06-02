@extends('admin.product.base')

@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Thêm mới sản phẩm</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-2 control-label">Tên sản phẩm</label>
                                <div class="col-md-8">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" autofocus>
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type" class="col-md-2 control-label">Loại sản phẩm</label>
                                <div class="col-md-4">
                                    <select name="category_id"  class="form-control type"  required>
                                        {!!$product_category!!}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-2 control-label">Slug</label>
                                <div class="col-md-8">
                                    <input id="slug" type="text" class="form-control" name="slug" value="" required readonly>
                                    @if ($errors->has('slug'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="avatar" class="col-md-2 control-label" >Hình ảnh</label>
                                <div class="col-md-6">
                                    <input type="file" id="image" name="image[]" multiple>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('price_min') ? ' has-error' : '' }}">
                                <label for="price_min" class="col-md-2 control-label">Giá cho sản phẩm nhỏ</label>
                                <div class="col-md-8">
                                    <input id="price_min" type="text" class="form-control" name="price_min" value="">
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('price_mid') ? ' has-error' : '' }}">
                                <label for="price_mid" class="col-md-2 control-label">Giá cho sản phẩm trung bình</label>
                                <div class="col-md-8">
                                    <input id="price_mid" type="text" class="form-control" name="price_mid" value="">
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('price_max') ? ' has-error' : '' }}">
                                <label for="price_max" class="col-md-2 control-label">Giá cho sản phẩm lớn</label>
                                <div class="col-md-8">
                                    <input id="price_max" type="text" class="form-control" name="price_max" value="">
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-2 control-label">Giới thiệu</label>

                                <div class="col-md-8">
                                    <textarea id="description" rows="10" class="form-control tinymce" name="description" value=""></textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                <label for="content" class="col-md-2 control-label">Nội dung</label>
                                <div class="col-md-8">
                                    <textarea id="content" rows="10" class="form-control tinymce" name="content"></textarea>

                                    @if ($errors->has('content'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Thêm
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
