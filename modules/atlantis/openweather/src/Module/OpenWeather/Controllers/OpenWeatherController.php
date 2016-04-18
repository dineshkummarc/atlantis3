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

    \Atlantis\Helpers\Assets::registerScript('https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js', 10);


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

    if (!isset($aData['error'])) {
      \Atlantis\Helpers\Assets::registerJS(view('openweather::now-js', $aData));
    }

    return view('openweather::now', $aData);
  }

  /**
   * <div data-pattern-func="module:openweather@forecast"></div>
   * 5 days forecast
   */
  public function Forecast() {

    $aData = array();
    $aData['oData'] = NULL;

    $openWeather = OpenWeatherRepository::get();
    $oData = OpenWeatherDataRepository::get5DaysData();

    if ($oData != NULL && $openWeather != NULL) {

      $aData['oData'] = unserialize($oData->data);
      //dd($aData['oData']->list);
      if ($aData['oData']->cod == 200) {

        $aData['aData'] = $this->getWeatherByDays($aData['oData'], $openWeather);
      } else {

        $aData['error'] = $aData['oData']->message;
      }
    } else {
      $aData['error'] = 'Weather unavailable';
    }

    return view('openweather::forecast', $aData);
  }

  private function getWeatherByDays($oData, $openWeather) {

    $aData = array();

    $aDays = $this->splitByDayAndNight($oData);

    foreach ($aDays as $k => $d) {

      $day_main_temp = 0;
      $day_main_temp_min = 0;
      $day_main_temp_max = 0;
      $day_main_pressure = 0;
      $day_main_humidity = 0;
      $day_clouds_all = 0;
      $day_wind_speed = 0;

      $night_main_temp = 0;
      $night_main_temp_min = 0;
      $night_main_temp_max = 0;
      $night_main_pressure = 0;
      $night_main_humidity = 0;
      $night_clouds_all = 0;
      $night_wind_speed = 0;

      foreach ($d['day'] as $day) {
        $day_main_temp += $day->main->temp;
        $day_main_temp_min += $day->main->temp_min;
        $day_main_temp_max += $day->main->temp_max;
        $day_main_pressure += $day->main->pressure;
        $day_main_humidity += $day->main->humidity;
        $day_clouds_all += $day->clouds->all;
        $day_wind_speed += $day->wind->speed;
      }

      foreach ($d['night'] as $night) {
        $night_main_temp += $night->main->temp;
        $night_main_temp_min += $night->main->temp_min;
        $night_main_temp_max += $night->main->temp_max;
        $night_main_pressure += $night->main->pressure;
        $night_main_humidity += $night->main->humidity;
        $night_clouds_all += $night->clouds->all;
        $night_wind_speed += $night->wind->speed;
      }

      $day_count = count($d['day']);
      $aData[$k]['day'] = array();
      if ($day_count > 0) {
        $mid_key = $this->getMiddleKey($d['day']);

        if ($openWeather->temperature == 'F') {
          $day_main_temp = Data::kelvinToFahrenheit(round(($day_main_temp / $day_count), 2)) . ' °F';
          $day_main_temp_min = Data::kelvinToFahrenheit(round(($day_main_temp_min / $day_count), 2)) . ' °F';
          $day_main_temp_max = Data::kelvinToFahrenheit(round(($day_main_temp_max / $day_count), 2)) . ' °F';
        } else {
          $day_main_temp = Data::kelvinToCelsius(round(($day_main_temp / $day_count), 2)) . ' °C';
          $day_main_temp_min = Data::kelvinToFahrenheit(round(($day_main_temp_min / $day_count), 2)) . ' °C';
          $day_main_temp_max = Data::kelvinToFahrenheit(round(($day_main_temp_max / $day_count), 2)) . ' °C';
        }

        $aData[$k]['day'] = [
            'main_temp' => $day_main_temp,
            'main_temp_min' => $day_main_temp_min,
            'main_temp_max' => $day_main_temp_max,
            'main_pressure' => round(($day_main_pressure / $day_count), 2),
            'main_humidity' => round(($day_main_humidity / $day_count), 2),
            'clouds_all' => round(($day_clouds_all / $day_count), 2),
            'wind_speed' => round(($day_wind_speed / $day_count), 2),
            'weather_icon' => $d['day'][$mid_key]->weather[0]->icon,
            'weather_main' => $d['day'][$mid_key]->weather[0]->main,
            'weather_description' => $d['day'][$mid_key]->weather[0]->description
        ];
      }

      $night_count = count($d['night']);
      $aData[$k]['night'] = array();
      if ($night_count > 0) {
        $mid_key = $this->getMiddleKey($d['night']);

        if ($openWeather->temperature == 'F') {
          $night_main_temp = Data::kelvinToFahrenheit(round(($night_main_temp / $night_count), 2)) . ' °F';
          $night_main_temp_min = Data::kelvinToFahrenheit(round(($night_main_temp_min / $night_count), 2)) . ' °F';
          $night_main_temp_max = Data::kelvinToFahrenheit(round(($night_main_temp_max / $night_count), 2)) . ' °F';
        } else {
          $night_main_temp = Data::kelvinToCelsius(round(($night_main_temp / $night_count), 2)) . ' °C';
          $night_main_temp_min = Data::kelvinToFahrenheit(round(($day_main_temp_min / $night_count), 2)) . ' °C';
          $night_main_temp_max = Data::kelvinToFahrenheit(round(($day_main_temp_max / $night_count), 2)) . ' °C';
        }

        $aData[$k]['night'] = [
            'main_temp' => $night_main_temp,
            'main_temp_min' => $night_main_temp_min,
            'main_temp_max' => $night_main_temp_max,
            'main_pressure' => round(($night_main_pressure / $night_count), 2),
            'main_humidity' => round(($night_main_humidity / $night_count), 2),
            'clouds_all' => round(($night_clouds_all / $night_count), 2),
            'wind_speed' => round(($night_wind_speed / $night_count), 2),
            'weather_icon' => $d['night'][$mid_key]->weather[0]->icon,
            'weather_main' => $d['night'][$mid_key]->weather[0]->main,
            'weather_description' => $d['night'][$mid_key]->weather[0]->description
        ];
      }
    }
    //dd($aData);
    return $aData;
  }

  private function splitByDayAndNight($oData) {

    $aDays = array();

    foreach ($oData->list as $l) {

      $dt = \Carbon\Carbon::createFromTimestamp($l->dt);
      $dateString = $dt->toDateString();

      if (!isset($aDays[$dateString])) {
        $aDays[$dateString]['day'] = array();
        $aDays[$dateString]['night'] = array();
      }

      if ($this->isNight($dt)) {
        array_push($aDays[$dateString]['night'], $l);
      } else {
        array_push($aDays[$dateString]['day'], $l);
      }
    }

    return $aDays;
  }

  private function isNight(\Carbon\Carbon $dt) {

    $dt1 = \Carbon\Carbon::create($dt->year, $dt->month, $dt->day, 20, 0, 0);

    $dt2 = \Carbon\Carbon::create($dt->year, $dt->month, $dt->day, 8, 0, 0);

    return !$dt->between($dt1, $dt2);
  }

  private function getMiddleKey($array) {

    $count = count($array);

    if ($count % 2 === 0) {
      return (int) floor(($count - 1) / 2);
    } else {
      return (int) floor($count / 2);
    }
  }

}
