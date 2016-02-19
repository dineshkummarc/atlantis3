<div class ="form-field {{ str_replace(':', '-', $item->field_type) }}{{ $required }}">
  <div class="form-title">
    {!! Form::label($item->field_name, $item->label, ['class' => '']) !!}
  </div>
  @foreach($checkboxes as $k => $checkbox)
  <label for="{{ $k }}">
    @if (stristr($checkbox, '::checked'))
    {!! Form::checkbox($k, 1, TRUE, array_merge(unserialize($item->attributes), ['id' => $k])) !!}{{ str_replace('::checked', '', $checkbox) }}
    @else
    {!! Form::checkbox($k, 1, FALSE, array_merge(unserialize($item->attributes), ['id' => $k])) !!}{{ $checkbox }}
    @endif
  </label>
  @endforeach
</div>