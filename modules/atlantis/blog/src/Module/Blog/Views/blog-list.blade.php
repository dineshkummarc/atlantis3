<h1>Blog List</h1>

@foreach ($oBlogs as $blog)

<div>
  @if (isset($featureImages[$blog->id]))
  <img src="{!! $featureImages[$blog->id]['thumbnail'] !!}">
  @endif
  <a href="{{ $anchor_url . '/' . $blog->url }}">{{ $blog->title }}</a>
</div>
@endforeach
