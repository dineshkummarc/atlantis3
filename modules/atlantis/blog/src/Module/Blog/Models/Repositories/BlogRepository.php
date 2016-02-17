<?php

namespace Module\Blog\Models\Repositories;

use Module\Blog\Models\Blog;
use Illuminate\Support\Facades\Validator;

class BlogRepository {

  /**
   *  Validation rules for create
   * 
   * @var array
   */
  private $rules_create = [
      'title' => 'required',
      'url' => 'required',
      'nickname' => 'required'
  ];

  public function validationCreate($data) {

    return Validator::make($data, $this->rules_create);
  }

  public function validationEdit($data) {

    return Validator::make($data, $this->rules_create);
  }

  public function add($data) {

    Blog::create($data);
  }

  public function edit($id, $data) {

    $model = Blog::findOrNew($id);

    if ($model != NULL) {
      $model->update($data);

      return TRUE;
    } else {
      return FALSE;
    }
  }

  public static function getAll() {

    return Blog::all();
  }

  public static function get($id) {

    return Blog::find($id);
  }
  
  public static function deleteEntry($id) {
    
    $model = Blog::findOrNew($id);

    if ($model != NULL) {
      $model->delete();

      return TRUE;
    } else {
      return FALSE;
    }
    
  }

}
