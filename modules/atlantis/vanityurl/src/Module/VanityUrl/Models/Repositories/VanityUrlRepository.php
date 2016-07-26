<?php

namespace Module\VanityUrl\Models\Repositories;

use Module\VanityUrl\Models\VanityUrl;
use Illuminate\Support\Facades\Validator;

class VanityUrlRepository {

  public function validationCreate($data, $cat_id = NULL) {

    /**
     *  Validation rules for create
     * 
     * @var array
     */
    $rules_create = [
        'source_url' => 'required|unique:vanityurl,source_url,' . $cat_id,
        'dest_url' => 'required'
    ];

    $messages = [
        'required' => trans('admin::validation.required'),
        'unique' => trans('admin::validation.unique')
    ];

    $validator = Validator::make($data, $rules_create, $messages);

    return $validator;
  }

  public function add($data) {

    $model = VanityUrl::create($data);

    return $model->id;
  }

  public function updateURL($id, $data) {

    $model = VanityUrl::find($id);
    if ($model != NULL) {
      $model->update($data);
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public static function get($id) {
    return VanityUrl::find($id);
  }

  public static function deleteURL($id) {

    $model = VanityUrl::find($id);
    if ($model != NULL) {
      $model->delete();
      return TRUE;
    } else {
      return FALSE;
    }
  }
  
  public static function findSourceURL($url) {
    
    return VanityUrl::where('source_url', '=', $url)->get()->first();
    
  }

}
