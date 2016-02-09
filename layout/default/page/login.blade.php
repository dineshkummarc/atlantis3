@extends('atlantis::page/shell')

@section('content')

<h1>Atlantis Login</h1>


@if( $errors->all() ) 
  @foreach($errors->all() as $error)
    <div class="alert alert-danger">
      {{ $error }}
    </div>
  @endforeach
@endif


<div id='loginForm'>
  {!! Form::open(["url" => "admin" . $urlQuery]) !!} 
    {!! Form::input("text", "username", '' , array("id" => "username")) !!}
      <br />
      {!! Form::input("password", "password", '' , array("id" => "password")) !!}
      {!! Form::submit('Login') !!}
  {!! Form::close() !!}
</div>  
@stop