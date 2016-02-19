<div class ="form-field {{ str_replace(':', '-', $item->field_type) }}{{ $required }}">
  <div class="form-title">
    {!! Form::label($item->field_name, $item->label, ['class' => '']) !!}
  </div>
  @foreach($radios as $k => $radio)
  <label for="{{ $k }}">
    @if (stristr($radio, '::checked'))
    {!! Form::radio($item->field_name, $k, TRUE, array_merge(unserialize($item->attributes), ['id' => $k])) !!}{{ str_replace('::checked', '', $radio) }}
    @else
    {!! Form::radio($item->field_name, $k, FALSE, array_merge(unserialize($item->attributes), ['id' => $k])) !!}{{ $radio }}
    @endif
  </label>
  @endforeach
</div>