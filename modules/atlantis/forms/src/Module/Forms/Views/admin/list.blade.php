@extends('atlantis-admin::admin-shell')

@section('content')

<h1>Forms List</h1>

<a href="/admin/modules/forms/add">ADD Form</a>


@foreach ($oModels as $model)
<div>
  <a href="/admin/modules/forms/edit/{{ $model->id }}">{{ $model->name }}</a> | <a href="/admin/modules/forms/delete/{{ $model->id }}">[DELETE]</a> | <a href="/admin/modules/forms/export-csv/{{ $model->id }}">[EXPORT CSV]</a>
</div>
@endforeach

@stop