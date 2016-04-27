@extends('atlantis-admin::admin-shell')

@section('scripts')
@parent
{{-- Add scripts per template --}}
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
        <h1 class="huge page-title">Add Menu</h1>
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
      </div>
    </div>
  </section>
  <section class="editscreen">
    {!! Form::open(array('url' => '/admin/modules/forms/add', 'data-abide' => '', 'novalidate'=> '')) !!}
    <div class="row">
      <div class="columns">
        <div class="float-right">
          <div class="buttons">
            {!! Form::input('submit', '_save_close', 'Save &amp; Close', ['class' => 'alert button', 'id'=>'save-close-btn']) !!}
            {!! Form::input('submit', '_update', 'Update', ['class' => 'alert button', 'id'=>'update-btn']) !!}
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="columns small-12">
        <ul class="tabs" data-tabs id="example-tabs">
          <li class="tabs-title is-active main">
            <!-- data-status: active, disabled or dev -->
            <a href="#panel1" aria-selected="true">New Form</a>
          </li>
        </ul>
        <div class="tabs-content" data-tabs-content="example-tabs">
          <div class="tabs-panel is-active" id="panel1">

            <div class="row">
              <div class="columns large-9">
                <div class="row">
                  <div class="columns medium-4">
                    @if ($errors->get('name'))
                    <label for="name" class="is-invalid-label"><span class="form-error is-visible">{{ $errors->get('name')[0] }}</span>
                      <span class="icon icon-Help top" data-tooltip title="This will be used to identify the Menu."></span>
                      {!! Form::input('text', 'name', old('name'), ['class' => 'is-invalid-input', 'id'=>'name']) !!}
                    </label>
                    @else
                    <label for="name">Form Name <span class="form-error">is required.</span>
                      <span class="icon icon-Help top" data-tooltip title="This will be used to identify the Menu."></span>
                      {!! Form::input('text', 'name', old('name'), ['id'=>'name', 'required'=>'required']) !!}
                    </label>
                    @endif
                  </div>
                  <div class="columns medium-4">
                    <label for="form_class">Form Class
                      {!! Form::input('text', 'form_class', old('form_class'), ['id'=>'form_class']) !!}
                    </label>                    
                  </div>
                  <div class="columns medium-4">
                    <label for="btn_value">Submit button name
                      {!! Form::input('text', 'btn_value', old('btn_value'), ['id' => 'btn_value']) !!}
                    </label>                    
                  </div>
                  <div class="columns medium-4">
                    <label for="btn_class">Button class
                      {!! Form::input('text', 'btn_class', old('btn_class'), ['id' => 'btn_class']) !!}
                    </label>                    
                  </div>
                  <div class="columns medium-4">
                    <label for="redirect_url">Redirect url
                      {!! Form::input('text', 'redirect_url', old('redirect_url'), ['id' => 'redirect_url']) !!}
                    </label>                    
                  </div>
                  <div class="columns">
                    <hr>
                    <label for="use_custom_form">Use Custom Template                      
                      <div class="switch tiny">
                        {!! Form::checkbox('use_custom_form', 1, FALSE, ['class' => 'switch-input', 'id' => 'use_custom_form']) !!}
                        <label class="switch-paddle" for="use_custom_form">
                          <span class="show-for-sr">
                          </span>
                        </label>
                      </div>
                    </label>                    
                  </div>
                  <div class="columns">
                    <label for="custom_form">Custom template
                      {!! \Editor::set('custom_form', old('custom_form'), ['rows' => 15, 'id' => 'custom_form']) !!}
                    </label>
                    <hr>
                  </div>
                  
                  
                  <div class="columns medium-4">
                    <label for="email_check">Should this form email its results?                      
                      <div class="switch tiny">
                        {!! Form::checkbox('email_check', 1, FALSE, ['class' => 'switch-input', 'id' => 'email_check']) !!}
                        <label class="switch-paddle" for="email_check">
                          <span class="show-for-sr">
                          </span>
                        </label>
                      </div>
                    </label>                    
                  </div>
                  <div class="columns medium-4">
                    <label for="email_from">Email From
                      {!! Form::input('text', 'email_from', old('email_from'), ['id' => 'email_from']) !!}
                    </label>                    
                  </div>
                
                  <div class="columns medium-4 end">
                    <label for="emails">Form Email Recipients, Comma Separated
                      {!! Form::input('text', 'emails', old('emails'), ['id' => 'emails']) !!}
                    </label>                    
                  </div>
                       
               
                  
                </div>
              </div>
              <div class="columns large-3">
                <aside>
                  <ul class="accordion" data-accordion>
                    <li class="accordion-item is-active" data-accordion-item>
                      <a href="#" class="accordion-title">Successful Submit Message</a>
                      <div class="accordion-content" data-tab-content>
                        {!! Form::textarea('message', old('message'), ['rows' => 5, 'id' => 'message']) !!}
                      </div>
                    </li>
                    <li class="accordion-item" data-accordion-item>
                      <a href="#" class="accordion-title">Google Analytics</a>
                      <div class="accordion-content" data-tab-content>
                        <p>Use Google Analytics</p>
                        <div class="switch tiny">
                          {!! Form::checkbox('ga', 1, TRUE, ['class' => 'switch-input', 'id' => 'gaSwitch']) !!}
                          <label class="switch-paddle" for="gaSwitch">
                            <span class="show-for-sr">
                              Cache Enabled
                            </span>
                          </label>
                        </div>
                      </div>
                    </li>
                    <li class="accordion-item" data-accordion-item>
                      <a href="#" class="accordion-title">Captcha</a>
                      <div class="accordion-content" data-tab-content>
                        <div class="row">
                          <div class="columns small-6">
                            <label for="captchaSwitch">Use Captcha</label>
                            <div class="switch tiny">
                              {!! Form::checkbox('captcha', 1, FALSE, ['class' => 'switch-input', 'id' => 'captchaSwitch']) !!}
                              <label class="switch-paddle" for="captchaSwitch">
                                <span class="show-for-sr">
                                  Use Captcha
                                </span>
                              </label>
                            </div>
                          </div>
                          <div class="columns small-6">
                            <label for="select_captcha">Select captcha</label>
                            {!! Form::select('select_captcha', $aCaptcha, NULL, ['id' => 'select_captcha']) !!}
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="accordion-item" data-accordion-item>
                      <a href="#" class="accordion-title">Before form text</a>
                      <div class="accordion-content" data-tab-content>                        
                        {!! Form::textarea('before_form_text', old('before_form_text'), ['rows' => 5, 'id'=>'before_form_text']) !!}
                      </div>
                    </li>
                    <li class="accordion-item" data-accordion-item>
                      <a href="#" class="accordion-title">After form text</a>
                      <div class="accordion-content" data-tab-content>                        
                        {!! Form::textarea('after_form_text', old('after_form_text'), ['rows' => 5, 'id'=>'after_form_text']) !!}
                      </div>
                    </li>                   
                  </ul>
                </aside>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </section>
</main>
<footer>
  @include('menus-admin::admin/help-sections/menus')
  <div class="row">
    <div class="columns">
    </div>
  </div>
</footer>
@stop
