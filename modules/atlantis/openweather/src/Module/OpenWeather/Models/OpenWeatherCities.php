<?php

namespace Module\OpenWeather\Models;

use Atlantis\Models\Base as Base;

class OpenWeatherCities extends Base {

  protected $table = "openweather_cities";

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name',
      'country',
      'lon',
      'lat'
  ];

}
