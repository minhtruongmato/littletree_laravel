@extends('admin.product.base')

@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Chỉnh sửa sản phẩm <strong style="color:red">{{ $product->name }}</strong></div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('product.update', ['id' => $product->id]) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-2 control-label">Tên sản phẩm</label>
                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $product->name }}" autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('trademark_id') ? ' has-error' : '' }}">
                                <label for="trademark_id" class="col-md-2 control-label">Thương hiệu</label>

                                <div class="col-md-8">
                                    <select name="trademark_id" id="trademark_id">
                                        <option value="">Chọn thương hiệu</option>
                                        @if(!empty($trademarks))
                                            @foreach($trademarks as $key => $item)
                                                <option value="{{ $key }}"
                                                        @if ($product->trademark_id == $key) selected="selected" @endif>
                                                    {{ $item }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('trademark_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('trademark_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                <label for="category_id" class="col-md-2 control-label">Danh mục</label>

                                <div class="col-md-8">
                                    <select name="category_id" id="category_id">
                                        <option value="">Chọn danh mục</option>
                                        @if(!empty($categories))
                                            @foreach($categories as $key => $item)
                                                <option value="{{ $key }}"
                                                        @if ($product->category_id == $key) selected="selected" @endif>
                                                    {{ $item }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" name="is_special" value="0">
                            <div class="form-group{{ $errors->has('is_special') ? ' has-error' : '' }}">
                                <label for="is_special" class="col-md-2 control-label">Sản phẩm đặc biệt?</label>
                                <div class="col-md-8">
                                    <input id="is_special" type="checkbox" class="minimal" name="is_special" value="1"
                                        @if($product->is_special == 1)
                                            checked
                                        @endif
                                    >
                                    @if ($errors->has('is_special'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('is_special') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" name="is_new" value="0">
                            <div class="form-group{{ $errors->has('is_new') ? ' has-error' : '' }}">
                                <label for="is_new" class="col-md-2 control-label">Sản phẩm mới?</label>
                                <div class="col-md-8">
                                    <input id="is_new" type="checkbox" class="minimal" name="is_new" value="1"
                                           @if($product->is_new == 1)
                                           checked
                                            @endif
                                    >
                                    @if ($errors->has('is_new'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('is_new') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
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
                                <label for="avatar" class="col-md-2 control-label" >Hình ảnh</label>
                                <div class="col-md-6">
                                    <input type="file" id="image" name="image">
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                <label for="quantity" class="col-md-2 control-label">Số lượng</label>
                                <div class="col-md-8">
                                    <input id="quantity" type="text" class="form-control" name="quantity" value="{{ $product->quantity }}" required>
                                    @if ($errors->has('quantity'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('effect') ? ' has-error' : '' }}">
                                <label for="effect" class="col-md-2 control-label">Công dụng</label>
                                <div class="col-md-8">
                                    <textarea id="effect" type="text" class="form-control" name="effect">{{ $product->effect }}</textarea>
                                    @if ($errors->has('effect'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('effect') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                                <label for="weight" class="col-md-2 control-label">Trọng lượng</label>
                                <div class="col-md-8">
                                    <input id="weight" type="text" class="form-control" name="weight" value="{{ $product->weight }}">
                                    @if ($errors->has('weight'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('weight') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('producer') ? ' has-error' : '' }}">
                                <label for="producer" class="col-md-2 control-label">Nhà sản xuất</label>
                                <div class="col-md-8">
                                    <input id="producer" type="text" class="form-control" name="producer" value="{{ $product->producer }}">
                                    @if ($errors->has('producer'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('producer') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label for="price" class="col-md-2 control-label">Đơn giá (VNĐ)</label>
                                <div class="col-md-4">
                                    <input id="price" type="text" class="form-control" name="price" value="{{ $product->price }}" required>
                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-1 control-label"><strong>VNĐ</strong></div>
                            </div>
                            <input type="hidden" name="is_discount" value="0">
                            <div class="form-group{{ $errors->has('is_discount') ? ' has-error' : '' }}">
                                <label for="is_discount" class="col-md-2 control-label">Sản phẩm khuyến mại?</label>
                                <div class="col-md-8">
                                    <input id="is_discount" type="checkbox" class="minimal" name="is_discount" value="1"
                                           @if($product->is_discount == 1)
                                           checked
                                            @endif
                                    >
                                    @if ($errors->has('is_discount'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('is_discount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('discount_percent') ? ' has-error' : '' }}">
                                <label for="discount_percent" class="col-md-2 control-label">Giá khuyến mại (%)</label>
                                <div class="col-md-3">
                                    <input id="discount_percent" type="text" class="form-control" name="discount_percent" value="{{ $product->discount_percent }}" required>
                                    @if ($errors->has('discount_percent'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('discount_percent') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-1 control-label"><strong>%</strong></div>
                            </div>
                            <div class="form-group{{ $errors->has('discount_price') ? ' has-error' : '' }}">
                                <label for="discount_price" class="col-md-2 control-label">Giá khuyến mại (thành tiền)</label>
                                <div class="col-md-4">
                                    <input id="discount_price" type="text" class="form-control" name="discount_price" value="{{ $product->discount_price }}" required>
                                    @if ($errors->has('discount_price'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('discount_price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-1 control-label"><strong>VNĐ</strong></div>
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
