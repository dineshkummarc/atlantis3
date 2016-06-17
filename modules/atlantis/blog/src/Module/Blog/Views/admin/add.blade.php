@extends('atlantis-admin::admin-shell')

@section('scripts')
@parent
{!! Html::script('vendor/atlantis-labs/atlantis3-framework/src/Atlantis/Assets/js/foundation-datepicker.min.js') !!}
{!! Html::script('vendor/atlantis-labs/atlantis3-framework/src/Atlantis/Assets/js/plugins/tagsInput/jquery.tagsinput.min.js') !!}
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
        <h1 class="huge page-title">Add Entry</h1>
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
    {!! Form::open(array('url' => '/admin/modules/blog/add', 'data-abide' => '', 'novalidate'=> '')) !!}
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
            <a href="#panel1" aria-selected="true">New Entry</a>
          </li>
        </ul>
        <div class="tabs-content" data-tabs-content="example-tabs">
          <div class="tabs-panel is-active" id="panel1">

            <div class="row">
              <div class="columns large-9">
                <div class="row">
                  <div class="columns medium-4">
                    @if ($errors->get('title'))
                    <label for="title" class="is-invalid-label"><span class="form-error is-visible">{{ $errors->get('title')[0] }}</span>
                      {!! Form::input('text', 'title', old('title'), ['class' => 'is-invalid-input', 'id'=>'title']) !!}
                    </label>
                    @else
                    <label for="title">Title <span class="form-error">is required.</span>
                      {!! Form::input('text', 'title', old('title'), ['required'=>'required', 'id'=>'title']) !!}
                    </label>
                    @endif
                  </div>
                  <div class="columns medium-4">
                    @if ($errors->get('url'))
                    <label for="url" class="is-invalid-label"><span class="form-error is-visible">{{ $errors->get('url')[0] }}</span>
                      {!! Form::input('text', 'url', old('url'), ['class' => 'is-invalid-input', 'id'=>'url']) !!}
                    </label>
                    @else
                    <label for="url">Entry Url <span class="form-error">is required.</span>
                      {!! Form::input('text', 'url', old('url'), ['required'=>'required', 'id'=>'url']) !!}
                    </label>
                    @endif                    
                  </div>
                  <div class="columns medium-4">

                    @if ($errors->get('posted_date'))
                    <label for="posted_date" class="is-invalid-label"><span class="form-error is-visible ">{{ $errors->get('posted_date')[0] }}</span>
                      <span class="fa fa-calendar dtp-wrapper">
                        {!! Form::input('text', 'posted_date', old('posted_date'), ['class' => 'is-invalid-input dtp', 'id'=>'posted_date']) !!}
                      </span> 
                    </label>
                    @else
                    <label for="posted_date">Posted Date
                      <span class="fa fa-calendar dtp-wrapper">
                        {!! Form::input('text', 'posted_date', old('posted_date'), ['class' => 'dtp', 'id'=>'posted_date']) !!}
                      </span> 
                    </label>
                    @endif
                  </div>
                  <div class="columns medium-4">
                    @if ($errors->get('nickname'))
                    <label for="nickname" class="is-invalid-label"><span class="form-error is-visible">{{ $errors->get('nickname')[0] }}</span>
                      {!! Form::input('text', 'nickname', old('nickname', $nickname), ['class' => 'is-invalid-input', 'id'=>'nickname']) !!}
                    </label>
                    @else
                    <label for="nickname">Nickname <span class="form-error">is required.</span>
                      {!! Form::input('text', 'nickname', old('nickname', $nickname), ['required'=>'required', 'id'=>'nickname']) !!}
                    </label>
                    @endif                 
                  </div>
                  <div class="columns medium-4">
                    <label for="allow_comments">Comments
                      {!! Form::select('allow_comments', $allow_comments_dropdown, NULL, ['id' => 'form-allow_comments']) !!}
                    </label>                    
                  </div>
                  <div class="columns medium-4">
                    <label for="status">Status
                      {!! Form::select('status', $status_dropdown, NULL, ['id' => 'form-status']) !!}
                    </label>                    
                  </div>
                  <div class="columns medium-4">
                    <label for="">Tags
                      {!! Form::input('text', 'tags', old('tags'), ['class' => 'inputtags']) !!}
                    </label>
                  </div>                  
                  <div class="columns end">
                    <label for="custom_form">Body
                      {!! \Editor::set('body', old('body'), ['rows' => 15, 'id' => 'custom_form']) !!}
                    </label>
                  </div>
                </div>
              </div>
              <div class="columns large-3">
                <aside>
                  <ul class="accordion" data-accordion>
                    <li class="accordion-item is-active" data-accordion-item>
                      <a href="#" class="accordion-title">Blurb</a>
                      <div class="accordion-content" data-tab-content>
                        {!! Form::textarea('blurb', old('blurb'), ['rows' => 5, 'id' => 'blurb']) !!}
                        <p>Use Blurb</p>
                        <div class="switch tiny">
                          {!! Form::checkbox('use_blurb', 1, FALSE, ['class' => 'switch-input', 'id' => 'useBlurbSwitch']) !!}
                          <label class="switch-paddle" for="useBlurbSwitch">
                            <span class="show-for-sr">
                            </span>
                          </label>
                        </div>
                        <p>or set how many words you want to use from body</p>
                        {!! Form::input('text', 'body_words', old('body_words', 10), []) !!}
                      </div>
                    </li>
                  </ul>
                </aside>
              </div>
            </div>
            {!! \MediaTools::createGallerySelector() !!}           
            
          </div>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </section>
</main>
<footer>
  
  <div class="row">
    <div class="columns">
    </div>
  </div>
</footer>
@stop
