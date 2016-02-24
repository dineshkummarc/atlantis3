<?php

namespace Module\Forms\Models\Repositories;

use Module\Forms\Models\FormsResults;
use Module\Forms\Models\Repositories\FormsItemsRepository;

class FormsResultsRepository {

  static function saveResults($data) {

    $aResults = array();

    $i = 0;

    $model = FormsResults::create([]);
    $model->delete();

    foreach ($data as $key => $value) {
      if ($key != '_token' && $key != 'form_id') {

        $item = FormsItemsRepository::findItem(['form_id' => $data['form_id'], 'field_name' => $key]);

        if ($item->id != NULL) {

          $aResults[$i]['form_id'] = $data['form_id'];
          $aResults[$i]['field_label'] = $item->label;
          $aResults[$i]['field_name'] = $key;
          $aResults[$i]['field_value'] = serialize($value);
          $aResults[$i]['post_url'] = request()->url();
          $aResults[$i]['IP'] = request()->ip();
          $aResults[$i]['set_id'] = $model->id;

          FormsResults::create($aResults[$i]);

          $i++;
        }
      }
    }
  }

}
