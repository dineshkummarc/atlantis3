<?php

namespace Module\OpenWeather\Models;

use Atlantis\Models\Base as Base;

class OpenWeatherData extends Base {

  protected $table = "openweather_data";

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'data',
      'type'
  ];

}
