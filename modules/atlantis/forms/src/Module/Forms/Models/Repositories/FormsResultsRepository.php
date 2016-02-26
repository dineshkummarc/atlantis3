<?php

namespace Module\Forms\Models\Repositories;

use Module\Forms\Models\FormsResults;
use Module\Forms\Models\Repositories\FormsItemsRepository;
use Illuminate\Support\Facades\DB;

class FormsResultsRepository {

  static function saveResults(\Illuminate\Http\Request $request) {

    $aResults = array();

    $i = 0;

    $model = FormsResults::create([]);
    $model->delete();

    foreach ($request->all() as $key => $value) {
      if ($key != '_token' && $key != 'form_id') {

        $item = FormsItemsRepository::findItem(['form_id' => $request->get('form_id'), 'field_name' => $key]);

        if ($item->id != NULL) {

          if ($request->hasFile($key)) {

            $originalName = str_replace([' ', '.'], '_', $request->file($key)->getClientOriginalName());

            $fileName = 'form_' . $request->get('form_id') . '_set_' . $model->id . '_' . $i . '_' . substr($originalName, 0, 30) . '.' . $request->file($key)->getClientOriginalExtension();

            /** save file to media/user */
            $request->file($key)->move(base_path() . '/media/user', $fileName);

            $aResults[$i]['form_id'] = $request->get('form_id');
            $aResults[$i]['field_label'] = $item->label;
            $aResults[$i]['field_name'] = $key;
            $aResults[$i]['field_value'] = serialize($fileName);
            $aResults[$i]['post_url'] = request()->url();
            $aResults[$i]['IP'] = request()->ip();
            $aResults[$i]['set_id'] = $model->id;
          } else {
            $aResults[$i]['form_id'] = $request->get('form_id');
            $aResults[$i]['field_label'] = $item->label;
            $aResults[$i]['field_name'] = $key;
            $aResults[$i]['field_value'] = serialize($value);
            $aResults[$i]['post_url'] = request()->url();
            $aResults[$i]['IP'] = request()->ip();
            $aResults[$i]['set_id'] = $model->id;
          }

          FormsResults::create($aResults[$i]);

          $i++;
        }
      }
    }
  }

  public static function getResults($form_id) {  
    
    return FormsResults::where('form_id', '=', $form_id)
                    ->orderBy('set_id')
                    ->get();
  }

}
