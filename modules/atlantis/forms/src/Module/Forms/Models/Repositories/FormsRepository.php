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
    $data = $this->fitData($data);
    $model = Forms::create($data);

    foreach ($data['items'] as $item) {

      $item['form_id'] = $model->id;
      FormsItemsRepository::add($item);
    }

    return $model->id;
  }

  public function edit($id, $data) {
    $data = $this->fitData($data);
    $model = Forms::findOrNew($id);

    if ($model != NULL) {
      $model->update($data);

      FormsItemsRepository::edit($id, $data['items']);

      return TRUE;
    } else {
      return FALSE;
    }
  }

  private function fitData($data) {

    $itemsNames = \Module\Forms\Controllers\Admin\FormsAdminController::getItemsNames();

    $aItems = array();

    foreach ($itemsNames as $item_name) {
      if (isset($data[$item_name]) && is_array($data[$item_name])) {
        foreach ($data[$item_name] as $item_k => $item_v) {
          if ($item_name == 'attributes') {
            $aAttrs = array_filter(explode("\n", $item_v));
            $aAtt = array();
            foreach ($aAttrs as $attr) {
              $att = explode('=>', $attr);
              if (isset($att[0]) && isset($att[1])) {
                $aAtt[trim($att[0])] = trim($att[1]);
              } else if (isset($att[0]) && !isset($att[1])) {
                $aAtt[trim($att[0])] = '';
              }
            }
            $aItems[$item_k][$item_name] = serialize($aAtt);
          } else if ($item_name == 'field_value') {

            if (strpos($item_v, '=>') !== FALSE) {
              $aVals = array_filter(explode("\n", $item_v));
              $aVal = array();
              foreach ($aVals as $val) {
                $att = explode('=>', $val);
                if (isset($att[0]) && isset($att[1])) {
                  $aVal[trim($att[0])] = trim($att[1]);
                }
              }
              $aItems[$item_k][$item_name] = serialize($aVal);
            } else {
              $aItems[$item_k][$item_name] = serialize($item_v);
            }
          } else {
            $aItems[$item_k][$item_name] = $item_v;
          }
        }
        unset($data[$item_name]);
      }
    }
    $data['items'] = $aItems;
    //dd($data);
    return $data;
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
