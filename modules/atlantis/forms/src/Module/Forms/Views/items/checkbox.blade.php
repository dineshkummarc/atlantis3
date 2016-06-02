<div class ="form-field {{ str_replace(':', '-', $item->field_type) }}{{ $required }}">
  <div class="form-title">
    <label for="{!! $item->field_name !!}">{{ $item->label }}</label>
  </div>  
  {!! $checkboxes !!}
</div>