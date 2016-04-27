@extends('atlantis-admin::admin-shell')

@section('content')

<h1>Edit Form</h1>

@foreach ($errors->all() as $error)
<p>{{ $error }}</p>
@endforeach

{!! Form::open(array('url' => '/admin/modules/forms/edit/' . $oModel->id, 'class' => 'form-horizontal')) !!}
<p>
  <label>Form name</label>
  {!! Form::input('text', 'name', old('name', $oModel->name), ['class' => 'form-control']) !!}
</p>
<p>
  <label>Form class</label>
  {!! Form::input('text', 'form_class', old('form_class', $oModel->form_class), ['class' => 'form-control']) !!}
</p>

<hr>

<p>
  <label>Before form text</label>
  {!! Form::textarea('before_form_text', old('before_form_text', $oModel->before_form_text), ['rows' => 5, 'class' => 'form-control']) !!}
</p>
<p>
  <label>After form text</label>
  {!! Form::textarea('after_form_text', old('after_form_text', $oModel->after_form_text), ['rows' => 5, 'class' => 'form-control']) !!}
</p>
<p>
  <label>Custom template</label>
  {!! Form::textarea('custom_form', old('custom_form', $oModel->custom_form), ['rows' => 5, 'class' => 'form-control']) !!}
</p>

<hr>

<p>
  <label>Use captcha</label>
  {!! Form::checkbox('captcha', 1, $oModel->captcha, ['class' => 'form-control']) !!}
</p>
<p>
  <label>Select captcha</label>
  {!! Form::select('select_captcha', $aCaptcha, $captcha_select, ['class' => 'form-control']) !!}
</p>
<p>
  <label>Use Google Analytics</label>
  {!! Form::checkbox('ga', 1, $oModel->ga, ['class' => 'form-control']) !!}
</p>
<p>
  <label>Use Custom Template</label>
  {!! Form::checkbox('use_custom_form', 1, $oModel->use_custom_form, ['class' => 'form-control']) !!}
</p>

<hr>

<p>
  <label>Submit button name</label>
  {!! Form::input('text', 'btn_value', old('btn_value', $oModel->btn_value), ['class' => 'form-control']) !!}
</p>
<p>
  <label>Button class</label>
  {!! Form::input('text', 'btn_class', old('btn_class', $oModel->btn_class), ['class' => 'form-control']) !!}
</p>

<hr>

<p>
  <label>Successful Submit Message</label>
  {!! \Editor::set('message', old('message', $oModel->message), ['rows' => 5, 'class' => 'form-control']) !!}
</p>
<p>
  <label>Redirect url</label>
  {!! Form::input('text', 'redirect_url', old('redirect_url', $oModel->redirect_url), ['class' => 'form-control']) !!}
</p>
<hr>

<p>
  <label>Should this form email its results?</label>
  {!! Form::checkbox('email_check', 1, $oModel->email_check, ['class' => 'form-control']) !!}
</p>
<p>
  <label>Email From</label>
  {!! Form::input('text', 'email_from', old('email_from', $oModel->email_from), ['class' => 'form-control']) !!}
</p>
<p>
  <label>Form Email Recipients, Comma Separated</label>
  {!! Form::input('text', 'emails', old('emails', $oModel->emails), ['class' => 'form-control']) !!}
</p>

<hr>

<button type="submit">Submit</button>
{!! Form::close() !!}

@stop