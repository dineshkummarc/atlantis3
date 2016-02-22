{!! Form::open(array('url' => $url, 'class' => $form->form_class, 'name' => $form->name, 'id' => 'form-' . $escaped_name)) !!}
<input type="hidden" name="form_id" value="{{ $form->id }}">
@if (Session::has('success'))
  {{-- show success message --}}
  <div class="success">   
    <span class="success-msg">{{ Session::get('success') }}</span>    
  </div>
  @endif
{!! $content !!}
{!! Form::close() !!}