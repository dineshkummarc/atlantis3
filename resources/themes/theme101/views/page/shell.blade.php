<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title'){!! $_page->seo_title !!}</title>

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
    
    {!! MenuNavigation::setShortcutBar() !!}

    @section('tracking_header')
    {!! $tracking_header !!}
    @show

    @if (isset($patt_header))
    {!! $patt_header !!}
    @endif

    @section('content')
    @show

    @if (isset($patt_footer))
    {!! $patt_footer !!}
    @endif

    @section('js')
    @foreach( $_js as $js )
    {!! $js !!}
    @endforeach
    @show

  </body>
</html>