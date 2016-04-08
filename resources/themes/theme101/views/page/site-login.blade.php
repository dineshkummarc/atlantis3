@extends('atlantis::' . config('frontend_shell_view'))

@section('content')

<h1>Page Protected Login</h1>


@if( $errors->all() ) 
  @foreach($errors->all() as $error)
    <div class="alert alert-danger">
      {{ $error }}
    </div>
  @endforeach
@endif


<div id='loginForm'>
  {!! Form::open(["url" => \Site\Controllers\SiteLoginController::$route_login . $urlQuery]) !!} 
    {!! Form::input("text", "username", '' , array("id" => "username")) !!}
      <br />
      {!! Form::input("password", "password", '' , array("id" => "password")) !!}
      {!! Form::submit('Login') !!}
  {!! Form::close() !!}
</div>  
@stop