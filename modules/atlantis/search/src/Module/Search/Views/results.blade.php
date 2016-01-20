<div class="search-results">
  <ul>
@foreach($results as $res)
  @foreach($res as $name => $url)
    <li>{!! Html::link( $url , $name  )  !!}</li>
  @endforeach
@endforeach
  </ul>
</div>
