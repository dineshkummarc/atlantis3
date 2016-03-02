<?php

namespace Module\CKEditor;

class CKEditorBuilder implements \Atlantis\Helpers\Interfaces\EditorBuilderInterface {

  public function build($name, $value, $attributes) {

    $aData = array();
    
    if (!array_key_exists('id', $attributes)) {
      $attributes['id'] = 'ckeditor-' . rand(0, 999);
    }
    
    $aData['name'] = $name;
    $aData['value'] = $value;
    $aData['attributes'] = $attributes;
    
    return view('ckeditor::ckeditor', $aData);
  }

  public function scripts() {
    
    $pathVendor = \Config::get('modules_dir') . \Config::get('ckeditor.setup.path') . '/Module/CKEditor/Vendor';
    
    return [
        'ckeditor' => $pathVendor . '/ckeditor/ckeditor.js',
    ];
  }

  public function styles() {

    return [];
  }

}
