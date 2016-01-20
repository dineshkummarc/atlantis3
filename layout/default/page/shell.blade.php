<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@section('title') {!! $_page->title; !!} @show</title>

    @section('tracking_header')
      {!! $tracking_header; !!}
    @show

    @section('scripts')
      @foreach( $_scripts as $script )
        {!! Html::script( $script ) !!}
      @endforeach
    @show
    
    @section('styles')
      @foreach( $_styles as $style) 
        {!! Html::style( $style ) !!}
      @endforeach
    @show

  </head>
  <body class="{!! $body_class !!}">
    @section('content')
    @show
  </body>
</html>