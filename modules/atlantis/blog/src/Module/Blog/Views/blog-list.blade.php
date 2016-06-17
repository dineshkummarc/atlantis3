<h1>Blog List</h1>

@foreach ($oBlogs as $blog)

<div>
  @if (isset($featuredImages[$blog->id]))
  <img src="{!! $featuredImages[$blog->id]['thumbnail'] !!}">
  @endif
  <a href="{{ $anchor_url . '/' . $blog->url }}">{{ $blog->title }}</a>
</div>
@endforeach
