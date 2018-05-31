@extends('admin.product.base')

@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Chỉnh sửa sản phẩm <strong style="color:red">{{ $product->name }}</strong></div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('product.update', ['id' => $product->id]) }}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
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
                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type" class="col-md-2 control-label">Loại sản phẩm</label>

                                <div class="col-md-4">
                                    <select name="type_id"  class="form-control type" data-page="{{ $product->kind_id }}" required>
                                        <option value="">---------------------Chọn loại sản phẩm---------------------</option>
                                        @foreach($type as $value)
                                            <option value="{{ $value->id }}" {{ ($value->id == $product->type_id)? 'selected' : ''}} >{{ $value->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('kind') ? ' has-error' : '' }}">
                                <label for="kind" class="col-md-2 control-label">Dòng sản phẩm</label>

                                <div class="col-md-4">
                                    <select name="kind_id"  class="form-control kind"  data-page="{{ $product->trademark_id }}" data-id="{{ $product->kind_id }}" >
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
                            <div class="form-group{{ $errors->has('concentrations') ? ' has-error' : '' }}">
                                <label for="concentrations" class="col-md-2 control-label">Nộng độ</label>
                                <div class="col-md-8">
                                    <input id="concentrations" type="text" class="form-control" name="concentrations" value="{{ $product->concentrations }}">
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
                                    <textarea id="capacity" type="text" class="form-control" name="capacity" value="{{ old('capacity') }}">{{ $product->capacity }}</textarea>
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
                                    <input id="material" type="text" class="form-control" name="material" value="{{ $product->material }}">
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
                                    <input id="year" type="text" class="form-control" name="year" value="{{ $product->year }}">
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
                                    <input id="producer" type="text" class="form-control" name="producer" value="{{ $product->producer }}">
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
                                    <input id="volume" type="text" class="form-control" name="volume" value="{{ $product->volume }}">
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
                                    <select name="origin_id"  class="form-control" autofocus>
                                        <option value="">-----------------------Chọn quốc gia-----------------------</option>
                                        @foreach($origin as $value)
                                            <option value="{{ $value->id }}" {{ ($value->id == $product->origin_id)? 'selected' : ''}} >{{ $value->name }}</option>
                                        @endforeach
                                    </select>
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
                            <div class="form-group{{ $errors->has('selling_price') ? ' has-error' : '' }}">
                                <label for="selling_price" class="col-md-2 control-label">Đơn giá bán (VNĐ)</label>
                                <div class="col-md-4">
                                    <input id="selling_price" type="text" class="form-control" name="selling_price" value="{{ $product->selling_price }}" required>
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
                            <input type="hidden" name="is_gift" value="0">
                            {{--<div class="form-group{{ $errors->has('is_gift') ? ' has-error' : '' }}">
                                <label for="is_gift" class="col-md-2 control-label">Quà tặng khuyến mại?</label>
                                <div class="col-md-8">
                                    <input id="is_gift" type="checkbox" class="minimal" name="is_gift" value="1"
                                           @if($product->is_discount == 1)
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
                                    <textarea id="gift" rows="10" class="form-control tinymce" name="gift" value="{{ old('gift') }}">{{ $product->gift }}</textarea>

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
