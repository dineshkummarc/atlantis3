<?php

namespace Module\OpenWeather\Helpers;

class Data {

  public static function saveNew() {

    $oOpenWeather = \Module\OpenWeather\Models\Repositories\OpenWeatherRepository::get();

    $oOpenWeatherCity = \Module\OpenWeather\Models\Repositories\OpenWeatherCitiesRepository::getCity();

    if ($oOpenWeather != NULL && $oOpenWeatherCity != NULL) {

      $nowData = self::getNow($oOpenWeather, $oOpenWeatherCity);
      $_5Daysdata = self::get5Days($oOpenWeather, $oOpenWeatherCity);

      if (self::isValidData($nowData)) {

        \Module\OpenWeather\Models\Repositories\OpenWeatherDataRepository::addNowData($nowData);
      }

      if (self::isValidData($_5Daysdata)) {

        \Module\OpenWeather\Models\Repositories\OpenWeatherDataRepository::add5DaysData($_5Daysdata);
      }
    }
  }

  public static function isValidData($data) {

    if (isset($data->cod)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public static function getNow($oOpenWeather, $oOpenWeatherCity) {

    $uri = 'http://api.openweathermap.org/data/2.5/weather?'
            . 'id=' . $oOpenWeatherCity->id
            . '&appid=' . $oOpenWeather->app_id;

    $client = new \GuzzleHttp\Client();

    try {
      $response = $client->request('GET', $uri);

      $content = json_decode($response->getBody()->getContents());       
    } catch (\GuzzleHttp\Exception\ClientException $exc) {
      $content = json_decode($exc->getResponse()->getBody()->getContents());
    }
    
    return $content;
  }

  public static function get5Days($oOpenWeather, $oOpenWeatherCity) {

    $uri = 'http://api.openweathermap.org/data/2.5/forecast?'
            . 'id=' . $oOpenWeatherCity->id
            . '&appid=' . $oOpenWeather->app_id;

    $client = new \GuzzleHttp\Client();

    try {
      $response = $client->request('GET', $uri);

      $content = json_decode($response->getBody()->getContents());       
    } catch (\GuzzleHttp\Exception\ClientException $exc) {
      $content = json_decode($exc->getResponse()->getBody()->getContents());
    }
    
    return $content;
  }

  public static function kelvinToCelsius($kelvin) {

    if (!is_numeric($kelvin)) {
      return '--';
    }
    return round(($kelvin - 273.15));
  }

  public static function kelvinToFahrenheit($kelvin) {

    if (!is_numeric($kelvin)) {
      return '--';
    }
    return round((($kelvin - 273.15) * 1.8) + 32);
  }

}
