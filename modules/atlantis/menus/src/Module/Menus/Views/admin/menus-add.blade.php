@extends('atlantis-admin::admin-shell')

@section('scripts')
@parent
{{-- Add scripts per template --}}
@stop

@section('styles')
@parent
{{-- Add styles per template --}}
@stop

@section('content')
<main>
  <section class="greeting">
    <div class="row">
      <div class="columns ">
        <h1 class="huge page-title">Add Menu</h1>
        @if (isset($msgInfo))
        <div class="callout warning">
          <h5>{!! $msgInfo !!}</h5>
        </div>
        @endif
        @if (isset($msgSuccess))
        <div class="callout success">
          <h5>{!! $msgSuccess !!}</h5>
        </div>
        @endif
        @if (isset($msgError))
        <div class="callout alert">
          <h5>{!! $msgError !!}</h5>
        </div>
        @endif
      </div>
    </div>
  </section>
  <section class="editscreen">
    {!! Form::open(['url' => 'admin/modules/menus/add', 'data-abide' => '', 'novalidate'=> '']) !!}
    <div class="row">
      <div class="columns">
        <div class="float-right">
          <div class="buttons">
            {!! Form::input('submit', '_save_close', 'Save &amp; Close', ['class' => 'alert button', 'id'=>'save-close-btn']) !!}
            {!! Form::input('submit', '_update', 'Update', ['class' => 'alert button', 'id'=>'update-btn']) !!}
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="columns small-12">
        <ul class="tabs" data-tabs id="example-tabs">
          <li class="tabs-title is-active main">
            <!-- data-status: active, disabled or dev -->
            <a href="#panel1" aria-selected="true">New Menu</a>
          </li>
        </ul>
        <div class="tabs-content" data-tabs-content="example-tabs">
          <div class="tabs-panel is-active" id="panel1">

            <div class="row">
              <div class="columns large-9">
                <div class="row">
                  <div class="columns medium-4">
                    @if ($errors->get('name'))
                    <label for="name" class="is-invalid-label"><span class="form-error is-visible">{{ $errors->get('name')[0] }}</span>
                      <span class="icon icon-Help top" data-tooltip title="This will be used to identify the Menu."></span>
                      {!! Form::input('text', 'name', old('name'), ['class' => 'is-invalid-input', 'id'=>'name']) !!}
                    </label>
                    @else
                    <label for="name">Menu Name <span class="form-error">is required.</span>
                      <span class="icon icon-Help top" data-tooltip title="This will be used to identify the Menu."></span>
                      {!! Form::input('text', 'name', old('name'), ['id'=>'name', 'required'=>'required']) !!}
                    </label>
                    @endif
                  </div>
                  <div class="columns medium-4">
                    <label for="css">Menu CSS Class
                      <span class="icon icon-Help top" data-tooltip title="Css class for the menu."></span>
                      {!! Form::input('text', 'css', old('css'), ['id'=>'css']) !!}
                    </label>                    
                  </div>
                  <div class="columns medium-4 end">
                    <label for="element_id">Menu Element ID
                      <span class="icon icon-Help top" data-tooltip title="ID of the menu."></span>
                      {!! Form::input('text', 'element_id', old('element_id'), ['id'=>'element_id']) !!}
                    </label>
                  </div>                 
                </div>
              </div>              
            </div>
            <div class="row">
              <div class="columns large-12">
                <hr>
                <div class="row menu-item" id="row_items_1">
                  <div class="columns large-3">
                    <label for="">
                      Item Label
                      {!! Form::input('text', 'label[]', NULL, []) !!}
                    </label>
                  </div>
                  <div class="columns large-3">
                    <label for="">
                      Item URL
                      {!! Form::input('text', 'url[]', NULL, []) !!}
                    </label>
                  </div>
                  <div class="columns large-1"> 
                    <label for="">
                      Weight
                      {!! Form::input('number', 'weight[]', 1, ['required'=>'required', 'min'=>'1']) !!}
                    </label>
                  </div>
                  <div class="columns large-3">
                    <label for="">
                      Item Attributes
                      {!! Form::input('text', 'attributes[]', NULL, []) !!}
                    </label>
                  </div>
                  <div class="columns large-2">
                    <a data-toggle="advanced-item1" class="button alert small"><span data-tooltip title="Show Advanced Settings" class="icon icon-Settings top"></span></a>
                    <a id="btn_delete_1" data-tooltip href="#" title="Delete Item" class="button alert small"><span class="icon icon-Delete"></span></a>
                  </div>
                  <div class="columns large-12 advanced" data-length="1" id="advanced-item1" data-toggler=".expanded">
                    <div class="row">
                      <div class="columns large-4">
                        <label for="">
                          Class
                          {!! Form::input('text', 'class[]', NULL, []) !!}
                        </label>  
                      </div>
                      <div class="columns large-4">
                        <label for="">
                          Item onClick
                          {!! Form::input('text', 'onclick[]', NULL, []) !!}
                        </label>
                      </div>
                      <div class="columns large-4">
                        <label for="">
                          Child Menu
                          {!! Form::select('child_id[]', $menus, NULL, []) !!}
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <a id="add-menu-item" data-tooltip href="#" title="Add New Item" class="button alert small"><span class="icon icon-Files"></span></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </section>
</main>
<footer>
  @include('menus-admin::admin/help-sections/menus')
  <div class="row">
    <div class="columns">
    </div>
  </div>
</footer>
@stop