<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@section('title') {!! $_page->seo_title !!} @show</title>

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
    
    @if (config('show_shortcut_bar') && auth()->user() != NULL && auth()->user()->hasRole('admin-login'))
    <div class="admin-shortcut">
      <link rel="stylesheet" href="vendor/atlantis-labs/atlantis3-framework/src/Atlantis/Assets/css/admin-bar.css"> 
      <div class="row">
        <div class="columns">
          <div class="top-bar" id="user-menu">
            <div class="top-bar-left user-menu">
              <div class="account">
                <span class="icon icon-User left"></span>
                <div class="username">Milen</div>
                <div class="actions">
                  <a href="#">Setings</a> / <a href="#">Loogout</a>
                </div>
              </div>
              <h3 class="menu-text left">Site Title</h3>
            </div>
            <span data-responsive-toggle="main-nav">
              <span class="menu-icon dark" data-toggle></span>
            </span>
            <div id="main-nav" class="top-bar-right">
              <ul class="dropdown menu" data-dropdown-menu>
                <li class="active"><a href="#">Pages</a></li>
                <li><a href="#">Patterns</a></li>
                <li><a href="#">Modules</a>
                  <ul class="menu vertical">
                    <li><a href="#">One</a></li>
                    <li><a href="#">Two</a></li>
                    <li><a href="#">Three</a></li>
                  </ul>
                </li>
                <li>
                  <a href="#" class="icon icon-Tools"></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>       
    </div>
    @endif
    
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
  </body>
</html>