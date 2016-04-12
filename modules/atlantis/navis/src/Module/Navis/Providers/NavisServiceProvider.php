<?php

namespace Module\Navis\Providers;

use Illuminate\Support\ServiceProvider;

class NavisServiceProvider extends ServiceProvider {

  public function register() {

    $this->app->bind("Navis", "Module\\Navis\\Controllers\\NavisController");


    //$subscriber = new \Navis\Events\Event();
    //\Event::subscribe($subscriber);
    //routes for modules should be included in the register method to preceed the base routes 

    include __DIR__ . '/../../../routes.php';
  }

  public function boot() {

    $themeModViewPath = \Atlantis\Helpers\Themes\ThemeTools::getFullThemePath() . '/modules/navis/views/';

    if (is_dir($themeModViewPath)) {
      $this->loadViewsFrom($themeModViewPath, 'navis');
    } else {
      $this->loadViewsFrom(__DIR__ . '/../Views/', 'navis');
    }

    $this->loadViewsFrom(__DIR__ . '/../Views/', 'navis-admin');
  }

}
