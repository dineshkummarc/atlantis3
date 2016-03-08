<?php

namespace Module\OpenWeather\Models\Repositories;

use Module\OpenWeather\Models\OpenWeatherData;

class OpenWeatherDataRepository {

  public static function addNowData($data) {

    $model = OpenWeatherData::where('type', '=', 'now')->get()->first();

    if ($model == NULL) {
      $model = new OpenWeatherData();
    }
    $model->data = serialize($data);
    $model->type = 'now';
    $model->save();
  }
  
  public static function add5DaysData($data) {

    $model = OpenWeatherData::where('type', '=', '5_days')->get()->first();

    if ($model == NULL) {
      $model = new OpenWeatherData();
    }
    $model->data = serialize($data);
    $model->type = '5_days';
    $model->save();
  }

  public static function getNowData() {

    return OpenWeatherData::where('type', '=', 'now')->get()->first();
  }
 
  public static function get5DaysData() {

    return OpenWeatherData::where('type', '=', '5_days')->get()->first();
  }

}
