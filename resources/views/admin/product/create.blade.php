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
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-2 control-label">Tên sản phẩm</label>
                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type" class="col-md-2 control-label">Loại sản phẩm</label>

                                <div class="col-md-4">
                                    <select name="type_id"  class="form-control type" required>
                                        <option value="">---------------------Chọn loại sản phẩm---------------------</option>
                                        @foreach($type as $value)
                                            <option value="{{ $value->id }}">{{ $value->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('kind') ? ' has-error' : '' }}">
                                <label for="kind" class="col-md-2 control-label">Dòng sản phẩm</label>

                                <div class="col-md-4">
                                    <select name="kind_id"  class="form-control kind">
                                        <option class="kind_option" value="">-------------------Chọn loại sản phẩm trước -------------------</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('trademark') ? ' has-error' : '' }}">
                                <label for="trademark" class="col-md-2 control-label">Thương hiệu sản phẩm</label>

                                <div class="col-md-4">
                                    <select name="trademark_id"  class="form-control trademark">
                                        <option class="trademark_option" value="">-------------------Chọn loại sản phẩm trước -------------------</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="is_special" value="0">
                            <div class="form-group{{ $errors->has('is_special') ? ' has-error' : '' }}">
                                <label for="is_special" class="col-md-2 control-label">Sản phẩm đặc biệt?</label>
                                <div class="col-md-8">
                                    <input id="is_special" type="checkbox" class="minimal" name="is_special" value="1"
                                        @if(old('is_special') == 1)
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
                                           @if(old('is_new') == 1)
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
                                <label for="slug" class="col-md-2 control-label">Slug</label>
                                <div class="col-md-8">
                                    <input id="slug" type="text" class="form-control" name="slug" value="{{ old('slug') }}" required readonly>
                                    @if ($errors->has('slug'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="avatar" class="col-md-2 control-label" >Hình ảnh</label>
                                <div class="col-md-8">
                                    <input type="file" id="image" name="image[]" required multiple>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                <label for="quantity" class="col-md-2 control-label">Số lượng</label>
                                <div class="col-md-8">
                                    <input id="quantity" type="number" class="form-control" name="quantity" value="{{ old('quantity') }}">
                                    @if ($errors->has('quantity'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('concentrations') ? ' has-error' : '' }}">
                                <label for="concentrations" class="col-md-2 control-label">Nộng độ</label>
                                <div class="col-md-8">
                                    <input id="concentrations" type="text" class="form-control" name="concentrations" value="{{ old('concentrations') }}">
                                    @if ($errors->has('concentrations'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('concentrations') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('capacity') ? ' has-error' : '' }}">
                                <label for="capacity" class="col-md-2 control-label">Dung tích</label>
                                <div class="col-md-8">
                                    <textarea id="capacity" type="text" class="form-control" name="capacity" value="{{ old('capacity') }}"></textarea>
                                    @if ($errors->has('capacity'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('capacity') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('material') ? ' has-error' : '' }}">
                                <label for="material" class="col-md-2 control-label">Nguyên liệu</label>
                                <div class="col-md-8">
                                    <input id="material" type="text" class="form-control" name="material" value="{{ old('material') }}">
                                    @if ($errors->has('material'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('material') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                                <label for="year" class="col-md-2 control-label">Niên vụ</label>
                                <div class="col-md-8">
                                    <input id="year" type="text" class="form-control" name="year" value="{{ old('year') }}">
                                    @if ($errors->has('year'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('year') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('producer') ? ' has-error' : '' }}">
                                <label for="producer" class="col-md-2 control-label">Nhà sản xuất</label>
                                <div class="col-md-8">
                                    <input id="producer" type="text" class="form-control" name="producer" value="{{ old('producer') }}">
                                    @if ($errors->has('producer'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('producer') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('volume') ? ' has-error' : '' }}">
                                <label for="volume" class="col-md-2 control-label">Thể tích</label>
                                <div class="col-md-8">
                                    <input id="volume" type="text" class="form-control" name="volume" value="{{ old('volume') }}">
                                    @if ($errors->has('volume'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('volume') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('origin') ? ' has-error' : '' }}">
                                <label for="origin" class="col-md-2 control-label">Xuất xứ</label>
                                <div class="col-md-4">
                                    <select name="origin_id"  class="form-control">
                                        <option value="">-----------------------Chọn quốc gia-----------------------</option>
                                        @foreach($origin as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label for="price" class="col-md-2 control-label">Đơn giá (VNĐ)</label>
                                <div class="col-md-4">
                                    <input id="price" type="text" class="form-control" name="price" value="{{ old('price') }}" required>
                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-1 control-label"><strong>VNĐ</strong></div>
                            </div>
                            <div class="form-group{{ $errors->has('selling_price') ? ' has-error' : '' }}">
                                <label for="selling_price" class="col-md-2 control-label">Đơn giá bán (VNĐ)</label>
                                <div class="col-md-4">
                                    <input id="selling_price" type="text" class="form-control" name="selling_price" value="{{ old('selling_price') }}" required>
                                    @if ($errors->has('selling_price'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('selling_price') }}</strong>
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
                                           @if(old('is_discount') == 1)
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
                                    <input id="discount_percent" type="text" class="form-control" name="discount_percent" value="{{ old('discount_percent') }}" required>
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
                                    <input id="discount_price" type="text" class="form-control" name="discount_price" value="{{ old('discount_price') }}" required>
                                    @if ($errors->has('discount_price'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('discount_price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-1 control-label"><strong>VNĐ</strong></div>
                            </div>

                            <input type="hidden" name="is_gift" value="0">
                            {{--<div class="form-group{{ $errors->has('is_gift') ? ' has-error' : '' }}">
                                <label for="is_gift" class="col-md-2 control-label">Quà tặng khuyến mại?</label>
                                <div class="col-md-8">
                                    <input id="is_gift" type="checkbox" class="minimal" name="is_gift" value="1"
                                           @if(old('is_gift') == 1)
                                           checked
                                            @endif
                                    >
                                    @if ($errors->has('is_gift'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('is_gift') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>--}}
                            <div class="form-group{{ $errors->has('gift') ? ' has-error' : '' }}">
                                <label for="gift" class="col-md-2 control-label">Nội dung quà tặng</label>

                                <div class="col-md-8">
                                    <textarea id="gift" rows="10" class="form-control tinymce" name="gift" value="{{ old('gift') }}"></textarea>
                                    @if ($errors->has('gift'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('gift') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-2 control-label">Giới thiệu</label>

                                <div class="col-md-8">
                                    <textarea id="description" rows="10" class="form-control tinymce" name="description" value="{{ old('description') }}"></textarea>

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
                                    <textarea id="content" rows="10" class="form-control tinymce" name="content" value="{{ old('content') }}"></textarea>

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
