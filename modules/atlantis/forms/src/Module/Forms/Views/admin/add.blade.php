@extends('atlantis-admin::admin-shell')

@section('content')

<h1>Add Form</h1>

@foreach ($errors->all() as $error)
<p>{{ $error }}</p>
@endforeach

{!! Form::open(array('url' => '/admin/modules/forms/add', 'class' => 'form-horizontal')) !!}
<p>
  <label>Form name</label>
  {!! Form::input('text', 'name', old('name'), ['class' => 'form-control']) !!}
</p>
<p>
  <label>Form class</label>
  {!! Form::input('text', 'form_class', old('form_class'), ['class' => 'form-control']) !!}
</p>

<hr>

<p>
  <label>Before form text</label>
  {!! Form::textarea('before_form_text', old('before_form_text'), ['rows' => 5, 'class' => 'form-control']) !!}
</p>
<p>
  <label>After form text</label>
  {!! Form::textarea('after_form_text', old('after_form_text'), ['rows' => 5, 'class' => 'form-control']) !!}
</p>
<p>
  <label>Custom template</label>
  {!! Form::textarea('custom_form', old('custom_form'), ['rows' => 5, 'class' => 'form-control']) !!}
</p>

<hr>

<p>
  <label>Use captcha</label>
  {!! Form::checkbox('captcha', 1, FALSE, ['class' => 'form-control']) !!}
</p>
<p>
  <label>Select captcha</label>
  {!! Form::select('select_captcha', $aCaptcha, NULL, ['class' => 'form-control']) !!}
</p>
<p>
  <label>Use Google Analytics</label>
  {!! Form::checkbox('ga', 1, TRUE, ['class' => 'form-control']) !!}
</p>
<p>
  <label>Use Custom Template</label>
  {!! Form::checkbox('use_custom_form', 1, FALSE, ['class' => 'form-control']) !!}
</p>

<hr>

<p>
  <label>Submit button name</label>
  {!! Form::input('text', 'btn_value', old('btn_value'), ['class' => 'form-control']) !!}
</p>
<p>
  <label>Button class</label>
  {!! Form::input('text', 'btn_class', old('btn_class'), ['class' => 'form-control']) !!}
</p>

<hr>

<p>
  <label>Successful Submit Message</label>
  {!! Form::textarea('message', old('message'), ['rows' => 5, 'class' => 'form-control']) !!}
</p>

<hr>

<p>
  <label>Should this form email its results?</label>
  {!! Form::checkbox('email_check', 1, FALSE, ['class' => 'form-control']) !!}
</p>
<p>
  <label>Form Email Recipients, Comma Separated</label>
  {!! Form::input('text', 'emails', old('emails'), ['class' => 'form-control']) !!}
</p>

<hr>

<button type="submit">Submit</button>
{!! Form::close() !!}

@stop