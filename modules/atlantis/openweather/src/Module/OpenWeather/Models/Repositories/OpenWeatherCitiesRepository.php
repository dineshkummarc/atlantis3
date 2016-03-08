<?php

namespace Module\OpenWeather\Models\Repositories;

use Module\OpenWeather\Models\OpenWeatherCities;

class OpenWeatherCitiesRepository {

  public static function addCityID($id) {

    self::deleteAll();
    
    $model = new OpenWeatherCities();

    $model->id = $id;
    $model->save();
  }

  public static function getCity() {

    return OpenWeatherCities::all()->first();
  }
  
  public static function deleteAll() {
    
    $model = OpenWeatherCities::truncate();
    
    
  }

}
