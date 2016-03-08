<?php

/*
 * Config: OpenWeather
 * @Atlantis CMS
 * v 1.0
 */

return [
   /*
    * $this->app->bind("Module\OpenWeather", "Atlantis\\OpenWeather\\Controllers\\OpenWeatherController");
    * 
    * 'appBind' => [
    *    'Module\OpenWeather' => 'Module\\OpenWeather\\Controllers\\OpenWeatherController'
    *],
    *[
    *    'Module\OpenWeather\CustomController' => 'Module\\OpenWeather\\Controllers\\CustomController'
    *]
    */
    'appBind' => [
        'Module\Openweather' => 'Module\\OpenWeather\\Controllers\\OpenWeatherController'
    ]
   ];
