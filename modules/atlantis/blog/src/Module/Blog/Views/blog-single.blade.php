<h1>{{ $data->title }}</h1>

@foreach ($images as $image)

<img src="{!! $image->thumbnail !!}">

@endforeach

<p>{{ $data->body }}</p>