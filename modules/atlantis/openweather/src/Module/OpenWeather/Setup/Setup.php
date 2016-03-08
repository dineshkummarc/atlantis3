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
    'path' => 'atlantis/openweather/src',
    'moduleNamespace' => 'Module\OpenWeather',
    'seedNamespace' => 'Module\OpenWeather\Seed',    
    'seeder' => '\Module\OpenWeather\Seed\OpenWeatherSeeder',
    'provider' => 'Module\OpenWeather\Providers\OpenWeatherServiceProvider',
    'migration' => 'modules/atlantis/openweather/src/Module/OpenWeather/Migrations/',
    'extra' => null,
    'active' => 1
   ];
