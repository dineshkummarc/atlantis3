<h1>Colorbox</h1>

<h2>Elastic Transition</h2>
@foreach ($images as $image)
<p><a class="group1" href="{!! $image->original_filename !!}" title="{{ $image->caption }}">{{ $image->name }}</a></p>
@endforeach

<h2>Fade Transition</h2>
@foreach ($images as $image)
<p><a class="group2" href="{!! $image->original_filename !!}" title="{{ $image->caption }}">{{ $image->name }}</a></p>
@endforeach

<h2>No Transition + fixed width and height (75% of screen size)</h2>
@foreach ($images as $image)
<p><a class="group3" href="{!! $image->original_filename !!}" title="{{ $image->caption }}">{{ $image->name }}</a></p>
@endforeach

<h2>Slideshow</h2>
@foreach ($images as $image)
<p><a class="group4" href="{!! $image->original_filename !!}" title="{{ $image->caption }}">{{ $image->name }}</a></p>
@endforeach