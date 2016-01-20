@extends('atlantis::page/shell')

  @section('content')
  <div id='header'>
    
    {!! trans('site::messages.welcome'); !!}
    
     {!! $header !!}
  </div>
  <div id="content">
    {!! $content !!}
    </div>
  <div id="footer">
    {!! $footer !!}
    </div>  
@stop  