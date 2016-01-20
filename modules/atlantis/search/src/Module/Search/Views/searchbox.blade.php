<div class="searchform">
{!! Form::open() !!}
   {!! Form::input("text", "search", '' , array("id" => "searchbox")) !!}
   {!! Form::submit('Search') !!}
{!! Form::close() !!}
</div>