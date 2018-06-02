<div class="row">
  @php
    $index = 0;
  @endphp
  @foreach ($items as $item)
    <div class="col-md-6">
      <div class="form-group">
          @php
            $stringFormat =  strtolower(str_replace(' ', '', $item));
            $label = ($stringFormat == 'title') ? 'Tên Danh mục sản phẩm' : $stringFormat;
          @endphp
          <label for="input<?=$stringFormat?>" class="col-sm-5 control-label">{{$label}}</label>
          <div class="col-sm-7">
            <input value="{{isset($oldVals) ? $oldVals[$index] : ''}}" type="text" class="form-control" name="<?=$stringFormat?>" id="input<?=$stringFormat?>" placeholder="{{$label}}">
          </div>
      </div>
    </div>
  @php
    $index++;
  @endphp
  @endforeach
</div>