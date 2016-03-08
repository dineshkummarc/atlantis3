<?php

namespace Module\OpenWeather\Models;

use Atlantis\Models\Base as Base;

class OpenWeather extends Base {

  protected $table = "openweather";

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'app_id',
      'temperature'
  ];

}
