<?php

namespace Module\OpenWeather\Providers;

/*
 * Provider: OpenWeather
 * @Atlantis CMS
 * v 1.0
 */

class OpenWeatherServiceProvider extends \Illuminate\Support\ServiceProvider {

  /**
   * The Artisan commands provided by your application.
   *
   * @var array
   */
  protected $commands = [
      \Module\OpenWeather\Commands\GetDataCommand::class
  ];

  public function register() {

    /** Register artisan commands * */
    $this->commands($this->commands);

    $this->mergeConfigFrom(
            __DIR__ . '/../Setup/Setup.php', "openweather.setup"
    );

    $this->mergeConfigFrom(
            __DIR__ . '/../Setup/Config.php', "openweather.config"
    );

    $aConfig = \Config::get('openweather.config');

    if (isset($aConfig['appBind'])) {
      foreach ($aConfig['appBind'] as $key => $value) {
        $this->app->bind($key, $value);
      }
    }

    $subscriber = new \Module\OpenWeather\Events\OpenWeatherEvent();

    \Event::subscribe($subscriber);

    //routes for modules should be included in the register method to preceed the base routes

    include __DIR__ . '/../../../routes.php';
  }

  public function boot() {

    $this->loadViewsFrom(__DIR__ . '/../Views/', 'openweather');
  }

}
