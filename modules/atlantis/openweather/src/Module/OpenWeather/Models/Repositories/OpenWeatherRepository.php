<?php

namespace Module\OpenWeather\Models\Repositories;

use Module\OpenWeather\Models\OpenWeather;

class OpenWeatherRepository {

  public static function add($data) {

    $model = OpenWeather::find(1);

    if ($model == NULL) {
      $model = new OpenWeather();
      $model->create($data);
    } else {
      $model->update($data);
    }
  }

  public static function get() {

    return OpenWeather::find(1);
  }

}
