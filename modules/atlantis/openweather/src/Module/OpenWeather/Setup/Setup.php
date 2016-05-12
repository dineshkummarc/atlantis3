<?php


/*
 * Setup: OpenWeather
 * @Atlantis CMS
 * v 1.0
 */

return [
    'name' => 'OpenWeather',
    'author' => 'Atlantis CMS',
    'version' => '1.0',
    'adminURL' => 'admin/modules/openweather', // admin/modules/openweather
    'icon' => 'Umbrella', // http://docteur-abrar.com/wp-content/themes/thunder/admin/stroke-gap-icons/index.html
    'path' => 'atlantis/openweather/src',
    'moduleNamespace' => 'Module\OpenWeather',
    'seedNamespace' => 'Module\OpenWeather\Seed',    
    'seeder' => '\Module\OpenWeather\Seed\OpenWeatherSeeder',
    'provider' => 'Module\OpenWeather\Providers\OpenWeatherServiceProvider',
    'migration' => 'modules/atlantis/openweather/src/Module/OpenWeather/Migrations/',
    'extra' => NULL,
    'description' => 'Module to retrieve weather data from www.openweather.com. Features daily and weekly forecasts.'
   ];
