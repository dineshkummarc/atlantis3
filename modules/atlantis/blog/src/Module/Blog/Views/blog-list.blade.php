<h1>Blog List</h1>

@foreach ($oBlogs as $blog)
<div>
  <a href="{{ $anchor_url . '/' . $blog->url }}">{{ $blog->title }}</a>
</div>
@endforeach
