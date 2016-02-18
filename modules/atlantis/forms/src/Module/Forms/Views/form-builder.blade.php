<div class="form-wrapper" id="{{ $escaped_name }}">
  @if (!empty($form->before_form_text))
  <div class="form-text-before">
    {{ $form->before_form_text }}
  </div>
  @endif
  {!! Form::open(array('url' => $url, 'class' => $form->form_class, 'name' => $form->name, 'id' => 'form-' . $escaped_name)) !!}
  <input type="hidden" name="form_id" value="{{ $form->id }}">

  <div class="submit">
    @if ($form->ga == 1)
    <input type="submit" class="{{ $form->btn_class }}" value="{{ $form->btn_value }}" onClick="ga('send', 'event', 'Forms', '{{ $form->name }}', '{{ $form->btn_value }}');">
    @else
    <input type="submit" class="{{ $form->btn_class }}" value="{{ $form->btn_value }}">
    @endif
  </div>
  {!! Form::close() !!}
  @if (!empty($form->after_form_text))
  <div class="form-text-after">
    {{ $form->after_form_text }}
  </div>
  @endif
</div>