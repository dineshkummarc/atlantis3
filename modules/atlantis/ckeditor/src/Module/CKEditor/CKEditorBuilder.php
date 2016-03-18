<?php

namespace Module\CKEditor;

class CKEditorBuilder implements \Atlantis\Helpers\Interfaces\EditorBuilderInterface {

  private $aData = array();
  
  public function build($name, $value, $attributes) {
    
    if (!array_key_exists('id', $attributes)) {
      $attributes['id'] = 'ckeditor-' . rand(0, 999);
    }
    
    $this->aData['height'] = '15em';
    
    if (array_key_exists('rows', $attributes)) {
      $this->aData['height'] = $attributes['rows'] . 'em';
    }
    
    $this->aData['name'] = $name;
    $this->aData['value'] = $value;
    $this->aData['attributes'] = $attributes;
    
    return view('ckeditor::ckeditor', $this->aData);
  }

  public function scripts() {
    
    $pathVendor = \Config::get('modules_dir') . \Config::get('ckeditor.setup.path') . '/Module/CKEditor/Vendor';
    
    return [
        'ckeditor' => \Html::script($pathVendor . '/ckeditor/ckeditor.js'),
        'ckeditor-scripts' => view('ckeditor::ckeditor-script', $this->aData)
    ];
  }

  public function styles() {

    return [];
  }

}
