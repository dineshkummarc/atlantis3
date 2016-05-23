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
        <h1 class="huge page-title">Edit Item</h1>
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
    {!! Form::open(['url' => 'admin/modules/colorbox/edit/' . $model->id, 'data-abide' => '', 'novalidate'=> '']) !!}
    <div class="row">
      <div class="columns">
        <div class="float-right">
          <div class="buttons">
            <a href="/admin/modules/colorbox" class="back button tiny top primary" title="Go to List" data-tooltip>
              <span class=" back icon icon-Goto"></span>
            </a>
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
            <a href="#panel1" aria-selected="true">{{ $model->name }}</a>
            <span class="actions">
              <a data-open="deleteItem" data-tooltip title="Delete Item" class="icon icon-Delete top"></a>
            </span>
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
                      {!! Form::input('text', 'name', old('name', $model->name), ['class' => 'is-invalid-input', 'id'=>'name']) !!}
                    </label>
                    @else
                    <label for="name">Name <span class="form-error">is required.</span>
                      {!! Form::input('text', 'name', old('name', $model->name), ['id'=>'name', 'required'=>'required']) !!}
                    </label>
                    @endif
                  </div>                 
                   <div class="columns medium-4 end">
                  @if ($errors->get('gallery_id'))
                    <label for="gallery_id" class="is-invalid-label"><span class="form-error is-visible">{{ $errors->get('gallery_id')[0] }}</span>               
                      {!! Form::select('gallery_id', $aGalleries, $model->gallery_id, ['id' => 'gallery_id']) !!} 
                    </label>
                    @else
                     <label for="gallery_id">Galleries <span class="form-error">- please create and select gallery first.</span>
                      {!! Form::select('gallery_id', $aGalleries, $model->gallery_id, ['id' => 'gallery_id', 'required'=>'required']) !!} 
                    </label>
                    @endif
                  </div>                  
                </div>
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
  <div class="helper">
    <button type="button" class="icon icon-Bulb" data-panel-toggle="tips-panel"></button>
    <div class="right-panel side-panel" id="tips-panel" data-atlantis-panel>
      <ul class="accordion" data-accordion>
        <li class="accordion-item is-active" data-accordion-item>
          <a href="#" class="accordion-title">Tip 2</a>
          <div class="accordion-content" data-tab-content>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex possimus labore numquam assumenda et consectetur rem minima quis commodi nam atque corporis qui, exercitationem alias voluptatem magnam ad. Esse, ipsum.
          </div>
        </li>
        <li class="accordion-item" data-accordion-item>
          <a href="#" class="accordion-title">Tip 1</a>
          <div class="accordion-content" data-tab-content>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic, accusantium, laudantium? Veniam a officiis, consequatur. Voluptatibus, consectetur, nam temporibus in fugiat assumenda distinctio vitae modi architecto beatae provident voluptates magnam.
          </div>
        </li>
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="columns">
    </div>
  </div>
  {!! \Atlantis\Helpers\Modal::set('deleteItem', 'Delete Item', 'Are you sure you want to delete ' . $model->name, 'Delete', '/admin/modules/colorbox/delete/' . $model->id) !!}
</footer>
@endif
@stop