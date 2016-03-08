@extends('atlantis-admin::admin-shell')

@section('content')

<h1>OpenWeather</h1>
<hr>
<h3>Setup</h3>
{!! Form::open(array('url' => '/admin/modules/openweather/add-id', 'class' => 'form-horizontal')) !!}
<p>
  <label>APP ID</label>
  {!! Form::input('text', 'app_id', old('app_id', $app_id), ['class' => 'form-control']) !!}
</p>
<p>
  <label>Temperature</label>
  {!! Form::radio('temperature', 'C', $C, []) !!}  °C
  {!! Form::radio('temperature', 'F', $F, []) !!}  °F
</p>
<button type="submit">Change</button>
{!! Form::close() !!}
<hr>
<h3>Set City ID</h3>
{!! Form::open(array('url' => '/admin/modules/openweather/add-city', 'class' => 'form-horizontal')) !!}
<p>
  <label>City ID</label>
  {!! Form::input('text', 'id', old('id', $id), ['class' => 'form-control']) !!}
</p>
<button type="submit">Change</button>
{!! Form::close() !!}

@stop