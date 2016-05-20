<?php

namespace Module\Colorbox\Models\Repositories;

use Module\Colorbox\Models\Colorbox;
use Illuminate\Support\Facades\Validator;

class ColorboxRepository { 

  
  public function validationCreate($data, $id = NULL) {

    /**
     *  Validation rules for create
     * 
     * @var array
     */
    $rules_create = [
        'name' => 'required|unique:colorbox,name,' . $id,
        'gallery_id' => 'required'
    ];

    $messages = [
        'required' => trans('colorbox::validation.required'),
        'unique' => trans('colorbox::validation.unique')
    ];

    $validator = Validator::make($data, $rules_create, $messages);

    return $validator;
  }
  
  
  public function addItems($data) {

    $model = Colorbox::create($data);
    
    return $model->id;
  }
  
  public function editItem($id, $data) {
    
    $model = Colorbox::find($id);
    
    if ($model != NULL) {
      
      $model->update($data);
      
      return TRUE;
    } else {
      return FALSE;
    }
    
  }

    public static function getItem($id) {
    return Colorbox::find($id);
  }

    public static function deleteItem($id) {
    
    $model = Colorbox::find($id);
    
    if ($model != NULL) {
      $model->delete();
      return TRUE;
    } else {
      return FALSE;
    }
  }
   
}