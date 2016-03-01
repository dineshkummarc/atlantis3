@extends('atlantis::page/shell')

@section('tracking_header')
@parent
{{-- Add tracking header per template --}}
@stop

@section('scripts')
@parent
{{-- Add scripts per template --}}
{{-- <script src="http://a3.angel.dev.gentecsys.net/media/js/vendor/jquery.js"></script> --}}
@stop

@section('styles')
@parent
{{-- Add styles per template --}}
@stop

@section('content')
@parent
<div id="content">
  {!! $content !!}
</div>
@stop  