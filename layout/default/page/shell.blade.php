<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@section('title') {!! $_page->seo_title; !!} @show</title>

    @section('headTags')
    @foreach($_headTags as $tag)
    {!! $tag !!}
    @endforeach
    @show    

    @section('scripts')
    @foreach($_scripts as $script)
    {!! $script !!}
    @endforeach
    @show

    @section('styles')
    @foreach($_styles as $style) 
    {!! $style !!}
    @endforeach
    @show

  </head>
  <body class="{!! $body_class !!}">
    
    @section('tracking_header')
    {!! $tracking_header !!}
    @show
    
    @section('content')
    @show
  </body>
</html>