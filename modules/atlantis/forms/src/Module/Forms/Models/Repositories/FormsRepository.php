<?php

namespace Module\Forms\Models\Repositories;

use Module\Forms\Models\Forms;
use Illuminate\Support\Facades\Validator;
use Module\Forms\Models\Repositories\FormsItemsRepository;

class FormsRepository {

  /**
   *  Validation rules for create
   * 
   * @var array
   */
  private $rules_create = [
      'name' => 'required',
      'btn_value' => 'required'
  ];

  public function validationCreate($data) {

    return Validator::make($data, $this->rules_create);
  }

  public function validationEdit($data) {

    return Validator::make($data, $this->rules_create);
  }

  public function add($data) {

    $model = Forms::create($data);

    foreach ($data['items'] as $item) {

      $item['form_id'] = $model->id;
      FormsItemsRepository::add($item);
    }
  }

  public function edit($id, $data) {

    $model = Forms::findOrNew($id);

    if ($model != NULL) {
      $model->update($data);
      
      FormsItemsRepository::edit($id, $data['items']);

      return TRUE;
    } else {
      return FALSE;
    }
  }

  public static function getAll() {

    return Forms::all();
  }

  public static function get($id) {

    return Forms::find($id);
  }

  public static function deleteEntry($id) {

    $model = Forms::findOrNew($id);

    if ($model != NULL) {
      $model->delete();
      FormsItemsRepository::deleteItems($id);
      return TRUE;
    } else {
      return FALSE;
    }
  }

}
