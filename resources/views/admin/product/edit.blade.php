@extends('admin.product.base')

@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Chỉnh sửa sản phẩm <strong style="color:red">{{ $product->title }}</strong></div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('product.update', ['id' => $product->id]) }}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-2 control-label">Tên sản phẩm</label>
                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" name="title" value="{{ $product->title }}" autofocus>
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
                           <!--  <input type="hidden" name="is_special" value="0">
                           <input type="hidden" name="is_new" value="0"> -->
                            <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-2 control-label">Slug</label>
                                <div class="col-md-8">
                                    <input id="slug" type="text" class="form-control" name="slug" value="{{ $product->slug }}" required readonly>
                                    @if ($errors->has('slug'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="avatar" class="col-md-2 control-label" >Hình ảnh đang sử dụng</label>
                                <div class="col-md-6">
                                    <?php $image = json_decode($product->image);?>
                                    @if(is_array($image) == true)
                                        @foreach ($image as $val)
                                        <div style="position: relative; width: 150px; float: left; margin-right: 5%;">
                                            <button type="button" class="close remove-image" aria-label="Close" style="position: absolute; top: -10px; right: 5px; background: red; border-radius: 50%; padding: 0 7px 3px" title="Xóa" data-image="{{$val}}" data-id="{{$product->id}}">
                                                <span aria-hidden="true" style="cursor: pointer;">&times;</span>
                                            </button>
                                                {{ HTML::image('storage/app/products/'.$product->slug.'/'.$val, '', array('width' => 100)) }}
                                        </div>
                                        @endforeach
                                    @else
                                        {{ HTML::image('storage/app/'.$product->image, '', array('width' => 150)) }}
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
                                    <input id="price_min" type="text" class="form-control" name="price_min" value="{{ $product->price_min }}">
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('price_mid') ? ' has-error' : '' }}">
                                <label for="price_mid" class="col-md-2 control-label">Giá cho sản phẩm trung bình</label>
                                <div class="col-md-8">
                                    <input id="price_mid" type="text" class="form-control" name="price_mid" value="{{ $product->price_mid }}">
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('price_max') ? ' has-error' : '' }}">
                                <label for="price_max" class="col-md-2 control-label">Giá cho sản phẩm lớn</label>
                                <div class="col-md-8">
                                    <input id="price_max" type="text" class="form-control" name="price_max" value="{{ $product->price_max }}">
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-2 control-label">Giới thiệu</label>

                                <div class="col-md-8">
                                    <textarea id="description" rows="10" class="form-control tinymce" name="description" value="{{ old('description') }}">{{ $product->description }}</textarea>

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
                                    <textarea id="content" rows="10" class="form-control tinymce" name="content">{{ $product->content }}</textarea>

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
                                        Sửa
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
