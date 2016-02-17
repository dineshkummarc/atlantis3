@extends('atlantis-admin::admin-shell')

@section('content')

<h1>Add Entry</h1>

@foreach ($errors->all() as $error)
  <p>{{ $error }}</p>
@endforeach

{!! Form::open(array('url' => '/admin/modules/blog/add', 'class' => 'form-horizontal')) !!}
<p>
  <label>Title</label>
  {!! Form::input('text', 'title', old('title'), ['class' => 'form-control']) !!}
</p>
<p>
  <label>Entry Url</label>
  {!! Form::input('text', 'url', old('url'), ['class' => 'form-control']) !!}
</p>
<p>
  <label>Posted Date</label>
  {!! Form::input('text', 'posted_date', old('posted_date'), ['class' => 'form-control']) !!}
</p>
<p>
  <label>Nickname</label>
  {!! Form::input('text', 'nickname', old('nickname', $nickname), ['class' => 'form-control']) !!}
</p>
<p>
  <label>Comments</label>
  {!! Form::select('allow_comments', $allow_comments_dropdown, NULL, ['class' => 'form-control']) !!}
</p>
<p>
  <label>Status</label>
  {!! Form::select('status', $status_dropdown, NULL, ['class' => 'form-control']) !!}
</p>
<p>
  <label>Blurb</label>
  {!! Form::textarea('blurb', old('blurb'), ['rows' => 3, 'class' => 'form-control']) !!}
</p>
<p>
  <label>Use Blurb</label>
  {!! Form::checkbox('use_blurb', 1, FALSE, array('id'=>'use_blurb')) !!}
</p>
<p>
  <label>or set how many words you want to use from body</label>
  {!! Form::input('text', 'body_words', old('body_words', 10), ['class' => 'form-control']) !!}
</p>
<p>
  <label>Body</label>
  {!! Form::textarea('body', old('body'), ['rows' => 5, 'class' => 'form-control']) !!}
</p>
<button type="submit">Submit</button>
{!! Form::close() !!}

@stop