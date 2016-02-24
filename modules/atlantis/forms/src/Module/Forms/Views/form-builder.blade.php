<div class="form-wrapper" id="{{ $escaped_name }}">
  @if (!empty($form->before_form_text))
  <div class="form-text-before">
    {{ $form->before_form_text }}
  </div>
  @endif
  {!! Form::open(array('url' => $url, 'class' => $form->form_class, 'name' => $form->name, 'id' => 'form-' . $escaped_name)) !!}
  <input type="hidden" name="form_id" value="{{ $form->id }}">
  @if (Session::has('success'))
  {{-- show success message --}}
  <div class="success">   
    <span class="success-msg">{{ Session::get('success') }}</span>    
  </div>
  @endif
  @if ($errors->all())
  {{-- show errors --}}
  <div class="errors">
    @foreach($errors->all() as $error)
    <span class="error-msg">{{ $error }}</span>        
    @endforeach
  </div>
  @endif
  {{-- build form items --}}
  @foreach($items as $item)
  {!! $item !!}
  @endforeach
  {{-- Captcha --}}
  @if($captcha != NULL)
  <div class="captcha">
    {!! $captcha !!}
  </div>
  @endif
  {{-- submit button --}}
  <div class="submit">
    {!! $submit_button !!}
  </div>  
  {!! Form::close() !!}
  @if (!empty($form->after_form_text))
  <div class="form-text-after">
    {{ $form->after_form_text }}
  </div>
  @endif
</div>