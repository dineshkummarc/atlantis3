<div class ="form-field {{ str_replace(':', '-', $item->field_type) }}{{ $required }}">
  <div class="form-title">
    {!! Form::label($item->field_name, $item->label, ['class' => '']) !!}
  </div>
  {!! Form::select($item->field_name, $selects, $checked, unserialize($item->attributes)) !!}
</div>