<?php

namespace Module\OpenGraph\Providers;

/*
 * Provider: OpenGraph
 * @Atlantis CMS
 * v 1.0
 */

class OpenGraphServiceProvider extends \Illuminate\Support\ServiceProvider {

  public function register() {

    $this->mergeConfigFrom(
            __DIR__ . '/../Setup/Setup.php', "opengraph.setup"
    );

    $this->mergeConfigFrom(
            __DIR__ . '/../Setup/Config.php', "opengraph.config"
    );

    $aConfig = \Config::get('opengraph.config');

    if (isset($aConfig['appBind'])) {
      foreach ($aConfig['appBind'] as $key => $value) {
        $this->app->bind($key, $value);
      }
    }

    //routes for modules should be included in the register method to preceed the base routes

    include __DIR__ . '/../../../routes.php';
  }

  public function boot() {

    $subscriber = new \Module\OpenGraph\Events\OpenGraphEvent();

    \Event::subscribe($subscriber);
    
    $this->loadViewsFrom(__DIR__ . '/../Views/', 'opengraph');
  }

}
