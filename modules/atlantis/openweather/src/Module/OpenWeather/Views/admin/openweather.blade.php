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
        <h1 class="huge page-title">OpenWeather</h1>
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
              Setup
            </a>
          </li>
          <!-- <li class="tabs-title main">
            <a href="#panel2">
              Recently Used
            </a>
          </li> -->
          <li class="float-right list-filter">
            {{--<a data-open="configBlog" class="alert button">Config</a>--}}
          </li>	
        </ul>
        <div class="tabs-content" data-tabs-content="example-tabs">
          <div class="tabs-panel is-active" id="panel1">

            <div class="row">
              <div class="columns large-12">


                {!! Form::open(array('url' => '/admin/modules/openweather/add-id', 'data-abide' => '', 'novalidate'=> '')) !!}
                <div class="row">
                  <div class="columns medium-4">                   
                    <label for="app_id">API KEY
                      {!! Form::input('text', 'app_id', old('app_id', $app_id), ['id' => 'app_id']) !!}
                    </label>
                  </div>                 
                  <div class="columns medium-4 end">
                    <label>Temperature</label>                    
                      {!! Form::radio('temperature', 'C', $C, ['id' => 'temp1']) !!}<label for="temp1">°C</label>
                      {!! Form::radio('temperature', 'F', $F, ['id' => 'temp2']) !!}<label for="temp2">°F</label>
                    </label>
                  </div>                  
                </div>
                {!! Form::input('submit', '_update', 'Change', ['class' => 'alert button', 'id'=>'update-btn']) !!}
                {!! Form::close() !!}


                <hr>


                {!! Form::open(array('url' => '/admin/modules/openweather/add-city', 'data-abide' => '', 'novalidate'=> '')) !!}
                <div class="row">
                  <div class="columns medium-4 end">                   
                    <label for="id">City ID
                      {!! Form::input('text', 'id', old('id', $id), ['id' => 'id']) !!}
                    </label>
                  </div>                                 
                </div>
                {!! Form::input('submit', '_update', 'Change', ['class' => 'alert button', 'id'=>'update-btn']) !!}
                {!! Form::close() !!}


              </div>
            </div>

          </div>
          <!--<div class="tabs-panel" id="panel2">
          </div> -->
        </div>
      </div>
    </div>
  </section>
</main>
<footer>
  <div class="helper">
    <button type="button" class="icon icon-Bulb" data-panel-toggle="tips-panel"></button>
    <div class="right-panel side-panel" id="tips-panel" data-atlantis-panel>
      <ul class="accordion" data-accordion>
        <li class="accordion-item is-active" data-accordion-item>
          <a href="#" class="accordion-title">Tip 1</a>
          <div class="accordion-content" data-tab-content>
            <p>Register in <a href="http://home.openweathermap.org/users/sign_up" target="blank">OpenWeather</a> and copy API KEY.</p>
            <p>Find your city from <a href="http://openweathermap.org/find" target="blank">here</a>. Click on the city and get CITY ID.<br>
              Example:<br>
              CITY URL: <a href="http://openweathermap.org/city/2643734" target="blank">http://openweathermap.org/city/2643734</a><br>
              CITY ID: 2643734
            </p>
          </div>
        </li>        
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="columns">
    </div>
</footer>
@stop