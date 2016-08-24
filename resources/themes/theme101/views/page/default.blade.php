@extends('atlantis::' . config('atlantis.frontend_shell_view'))

@section('headTags')
@parent
{{-- Add custom tags in <head> per template --}}
{{-- <meta name="test"> --}}
@stop

@section('tracking_header')
@parent
{{-- Add tracking header per template --}}
@stop

@section('scripts')
@parent
{{-- Add scripts per template --}}
{{-- <script src="{{$_storage}}/media/js/vendor/jquery.js"></script> --}}
@stop

@section('styles')
@parent
{{-- Add styles per template --}}
@stop

@section('js')
@parent
{{-- Add js per template --}}
{{--  <script>
  $(document).ready(function () { ... --}}
@stop

@section('content')
@parent
<div id="content">
  {{-- trans('site::messages.welcome') --}}
  {!! $content !!}
</div>
@stop