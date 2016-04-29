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
@if (isset($invalid_item))
<div class="callout alert">
  <h5>{{ $invalid_item }}</h5>
</div>
@else
<main>
  <section class="greeting">
    <div class="row">
      <div class="columns ">
        <h1 class="huge page-title">Edit Menu</h1>
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
    {!! Form::open(['url' => 'admin/modules/menus/edit/' . $menu->id, 'data-abide' => '', 'novalidate'=> '']) !!}
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
            <a href="#panel1" aria-selected="true">{{ $menu->name }}</a>
            <span class="actions">
              <a data-open="deleteMenu" data-tooltip title="Delete Menu" class="icon icon-Delete top"></a>
            </span>
          </li>
        </ul>
        <div class="tabs-content" data-tabs-content="example-tabs">
          <div class="tabs-panel is-active" id="panel1">
            <div class="row">
              <div class="columns large-3">
                <div class="row">
                  <div class="columns">
                    @if ($errors->get('name'))
                    <label for="name" class="is-invalid-label"><span class="form-error is-visible">{{ $errors->get('name')[0] }}</span>
                      <span class="icon icon-Help top" data-tooltip title="This will be used to identify the Menu."></span>
                      {!! Form::input('text', 'name', old('name', $menu->name), ['class' => 'is-invalid-input', 'id'=>'name']) !!}
                    </label>
                    @else
                    <label for="name">Menu Name <span class="form-error">is required.</span>
                      <span class="icon icon-Help top" data-tooltip title="This will be used to identify the Menu."></span>
                      {!! Form::input('text', 'name', old('name', $menu->name), ['id'=>'name', 'required'=>'required']) !!}
                    </label>
                    @endif
                  </div>
                  <div class="columns ">
                    <label for="css">Menu CSS Class
                      <span class="icon icon-Help top" data-tooltip title="Css class for the menu."></span>
                      {!! Form::input('text', 'css', old('css', $menu->css), ['id'=>'css']) !!}
                    </label>                    
                  </div>
                  <div class="columns ">
                    <label for="element_id">Menu Element ID
                      <span class="icon icon-Help top" data-tooltip title="ID of the menu."></span>
                      {!! Form::input('text', 'element_id', old('element_id', $menu->element_id), ['id'=>'element_id']) !!}
                    </label>
                  </div>  
                  <div class="columns">
                    <a id="add-menu-item" data-tooltip href="#" title="Add New Item" class="button alert small">Add New Item</a>
                  </div>               
                </div>
              </div>              
              <div class="columns large-7 end">
                <hr>
                @foreach ($menu_items as $k => $item)                 
                <div class="row menu-item" id="row_items_{!! $k + 1 !!}">

                  <div class="columns">
                    <label for="" class="item-title">                        
                      @if (empty($item->label))
                      NEW ITEM
                      @else                      
                      {{ $item->label }}
                      @endif
                    </label>
                    <code>                   
                      /{{ $item->url }}
                    </code>
                    <span class="actions">
                      <a data-toggle="advanced-item{!! $k + 1 !!}" class=""><span data-tooltip title="Show Advanced Settings" class="icon icon-Settings top"></span></a>
                    </span>
                  </div>
                  <div class="columns">
                    <div class="row advanced" data-length="1" id="advanced-item{!! $k + 1 !!}" data-toggler=".expanded">
                      <div class="columns large-3">
                        <label for="">
                          Item Label
                          {!! Form::input('text', 'label[' . $item->id . ']', $item->label, []) !!}
                        </label>
                      </div>
                      <div class="columns large-3">
                        <label for="">
                          Item URL
                          {!! Form::input('text', 'url[' . $item->id . ']', $item->url, []) !!}
                        </label>
                      </div>

                      <div class="columns large-3">
                        <label for="">
                          Item Attributes
                          {!! Form::input('text', 'attributes[' . $item->id . ']', $item->attributes, []) !!}
                        </label>
                      </div>
                      <div class="columns large-2 end">
                        <label for="">
                          Weight
                          {!! Form::input('number', 'weight[' . $item->id . ']', $item->weight, ['required'=>'required', 'min'=>'1']) !!}
                        </label>
                      </div>

                      <div class="columns large-3">
                        <label for="">
                          Class
                          {!! Form::input('text', 'class[' . $item->id . ']', $item->class, []) !!}
                        </label>  
                      </div>
                      <div class="columns large-3">
                        <label for="">
                          Item onClick
                          {!! Form::input('text', 'onclick[' . $item->id . ']', $item->onclick, []) !!}
                        </label>
                      </div>
                      <div class="columns large-3">
                        <label for="">
                          Child Menu
                          {!! Form::select('child_id[' . $item->id . ']', $menus, $item->child_id, []) !!}
                        </label>
                      </div>
                      <div class="columns large-12">
                        <a id="btn_delete_{!! $k + 1 !!}" data-tooltip href="#" title="Delete Item" class="button alert small">Delete Item</a>
                      </div>
                    </div>
                  </div>

                </div>                
                @endforeach
                
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
  {!!  \Atlantis\Helpers\Modal::set('deleteMenu', 'Delete Menu', 'Are you sure you want to delete ' . $menu->name, 'Delete', '/admin/modules/menus/delete/' . $menu->id) !!}
</footer>
@endif
@stop