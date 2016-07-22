<?php

namespace Module\OpenWeather\Traits;

/**
 * Helper trait for extending OpenWeatherController
 */
trait OpenWeatherTrait {

  public function __call($name, $params) {
   
    /**
     * create controller in site/src/Module/Site/Controllers/Modules/OpenWeatherController.php
     */
    if (class_exists('Module\Site\Controllers\Modules\OpenWeatherController')) {

      return \App::make('Module\Site\Controllers\Modules\OpenWeatherController')->$name($params);
    }
  }

}
