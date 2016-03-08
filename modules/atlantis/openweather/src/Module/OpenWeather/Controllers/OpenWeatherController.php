<?php

namespace Module\OpenWeather\Controllers;

use Module\OpenWeather\Models\Repositories\OpenWeatherRepository;
use Module\OpenWeather\Models\Repositories\OpenWeatherDataRepository;
use Module\OpenWeather\Helpers\Data;

/*
 * Controller: OpenWeather
 * @Atlantis CMS
 * v 1.0
 */
use App\Http\Controllers\Controller;

class OpenWeatherController extends Controller {

  public function __construct() {
    
  }

  /**
   * <div data-pattern-func="module:openweather@now"></div>
   */
  public function now() {

    Data::saveNew();

    $openWeather = OpenWeatherRepository::get();
    $oData = OpenWeatherDataRepository::getNowData();

    $aData = array();
    $aData['oData'] = NULL;
    $aData['temp'] = '--' . '°';

    if ($oData != NULL && $openWeather != NULL) {

      $aData['oData'] = unserialize($oData->data);

      if ($aData['oData']->cod == 200) {
        if ($openWeather->temperature == 'F') {
          $aData['temp'] = Data::kelvinToFahrenheit($aData['oData']->main->temp) . ' °F';
        } else {
          $aData['temp'] = Data::kelvinToCelsius($aData['oData']->main->temp) . ' °C';
        }
      } else {

        $aData['error'] = $aData['oData']->message;
      }
    } else {
      $aData['error'] = 'Weather unavailable';
    }

    //dd($aData);

    return \View::make('openweather::now', $aData);
  }

}
