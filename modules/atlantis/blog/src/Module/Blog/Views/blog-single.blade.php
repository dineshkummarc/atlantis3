<h1>{{ $data->title }}</h1>

@foreach (\MediaTools::getImagesByGallery($data->gallery_id) as $image)

<img src="{!! $image->thumbnail !!}">

@endforeach

<p>{{ $data->body }}</p>