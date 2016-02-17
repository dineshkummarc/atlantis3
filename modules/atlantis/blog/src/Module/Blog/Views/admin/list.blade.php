@extends('atlantis-admin::admin-shell')

@section('content')

<h1>Blog List</h1>

<a href="/admin/modules/blog/add">ADD Entry</a>


@foreach ($oBlogs as $blog)
<div>
  <a href="/admin/modules/blog/edit/{{ $blog->id }}">{{ $blog->title }}</a> | <a href="/admin/modules/blog/delete/{{ $blog->id }}">[DELETE]</a>
</div>
@endforeach

@stop