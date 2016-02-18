<?php

namespace Module\Forms\Models\Repositories;

use Module\Forms\Models\FormsItems;

class FormsItemsRepository {

  public static function add($data) {

    if (is_array($data['attributes'])) {
      $data['attributes'] = serialize($data['attributes']);
    } else {
      $data['attributes'] = serialize(array());
    }

    if (is_array($data['field_value'])) {
      $data['field_value'] = serialize($data['field_value']);
    } else {
      $data['field_value'] = serialize(array());
    }

    FormsItems::create($data);
  }

  public static function edit($form_id, $data) {

    self::deleteItems($form_id);

    foreach ($data as $item) {

      $item['form_id'] = $form_id;
      self::add($item);
    }
  }
  
  public static function getItems($form_id) {
    
    return FormsItems::where('form_id', '=', $form_id)->get();
    
  }

  public static function deleteItems($form_id) {

    $model = FormsItems::where('form_id', '=', $form_id)->delete();
  }

}
