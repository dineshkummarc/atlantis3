<?php

namespace Module\Forms\Helpers;

use Maatwebsite\Excel\Facades\Excel;

class Export {

  public static function toCSV($modelFormsResults, $form_id) {

    $aData = array();

    $set_id = NULL;

    foreach ($modelFormsResults as $key => $result) {

      if ($set_id == $result->set_id) {

        $field_value = unserialize($result->field_value);

        if (is_array($field_value)) {
          $field_value = implode("\n", $field_value);
        }

        $aData[$key] = [
            'Field label' => $result->field_label,
            'Field name' => $result->field_name,
            'Field value' => $field_value,
            'POST URL' => $result->post_url,
            'IP' => $result->IP,
            'Added' => $result->created_at
        ];
      } else {
        /** add empty line */
        $aData[$key] = [
            'Field label' => '',
            'Field name' => '',
            'Field value' => '',
            'POST URL' => '',
            'IP' => '',
            'Added' => ''
        ];
      }
      $set_id = $result->set_id;
    }
    $date = \Carbon\Carbon::now()->toDateTimeString();

    Excel::create($form_id . '_form_export_' . $date, function($excel) use($aData) {

      $excel->sheet('sheet 1', function($sheet) use($aData) {

        $sheet->setOrientation('landscape');
        $sheet->fromArray($aData);
      });
    })->export('csv');
  }

}
