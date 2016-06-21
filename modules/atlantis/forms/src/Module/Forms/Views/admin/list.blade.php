@extends('atlantis-admin::admin-shell')

@section('scripts')
@parent
{{-- Add scripts per template --}}
{{-- <script src="http://a3.angel.dev.gentecsys.net/media/js/vendor/jquery.js"></script> --}}
@stop

@section('styles')
@parent
{{-- Add styles per template --}}
@stop

@section('content')
<main>
  <section class="greeting">
    <div class="row">
      <div class="columns ">        
        <h1 class="huge page-title">Forms</h1>
        @if (isset($msgInfo))
        <div class="callout warning">
          <h5>{!! $msgInfo !!}</h5>
        </div>
        @endif
        @if (isset($msgSuccess))
        <div class="callout success">
          <h5>{!! $msgSuccess !!}</h5>
        </div>
        @endif
        @if (isset($msgError))
        <div class="callout alert">
          <h5>{!! $msgError !!}</h5>
        </div>
        @endif
        <div class="float-right">
          <!-- <div class="buttons">
                  <a id="save-close-btn" class="alert button" href="#">New Page</a>
          </div> -->
        </div>
      </div>
    </div>
  </section>
  <section class="pages-list">
    <div class="row">
      <div class="columns small-12">
        <ul class="tabs" data-tabs id="example-tabs">
          <li class="tabs-title is-active main">
            <a href="#panel1" aria-selected="true">
              All Forms
            </a>
          </li>
          <!-- <li class="tabs-title main">
            <a href="#panel2">
              Recently Used
            </a>
          </li> -->
          <li class="float-right list-filter">
            <a data-open="configForms" class="alert button">Config</a>
            <a id="save-close-btn" class="alert button" href="/admin/modules/forms/add">Add Form</a>
          </li> 
        </ul>
        <div class="tabs-content" data-tabs-content="example-tabs">
          <div class="tabs-panel is-active" id="panel1">
            {!! DataTable::set(\Module\Forms\Controllers\Admin\FormsDataTable::class) !!}
          </div>
          <!--<div class="tabs-panel" id="panel2">
          </div> -->
        </div>
      </div>
    </div>
  </section>
</main>
<footer>
 
  <div class="row">
    <div class="columns">
    </div>
  </div>
  <div class="reveal" id="configForms" data-reveal>
    {!! Form::open(['url' => 'admin/modules/forms/update-config']) !!}    
    <h1>Config</h1>

    <hr>
    <h5>ReCaptcha</h5>    
    <p>Register API keys at <a href="https://www.google.com/recaptcha/admin" target="blank">https://www.google.com/recaptcha/admin</a></p>
    <label for="re_captcha_site_key">Site Key
      <span class="icon icon-Help top" data-tooltip title="Register API keys at https://www.google.com/recaptcha/admin"></span>
      {!! Form::input('text', 're_captcha_site_key', old('re_captcha_site_key', isset($config['re_captcha_site_key']) ? $config['re_captcha_site_key'] : NULL), ['id'=>'re_captcha_site_key']) !!}
    </label>    
    <label for="re_captcha_secret">Secret
      {!! Form::input('text', 're_captcha_secret', old('re_captcha_secret', isset($config['re_captcha_secret']) ? $config['re_captcha_secret'] : NULL), ['id'=>'re_captcha_secret']) !!}
    </label>
    <hr>

    <button class="close-button" data-close aria-label="Close modal" type="button">
      <span aria-hidden="true">&times;</span>
    </button>
    <input type="submit" name="_update_config" value="Update" id="update-btn" class="success button">
    {!! Form::close() !!}
  </div>
</footer>
@stop