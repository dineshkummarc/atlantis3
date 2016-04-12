<?php

namespace Module\Vanityurl\Providers;

class VanityurlServiceProvider extends \Illuminate\Support\ServiceProvider {

  public function register() {

    $this->app->bind("Vanityurl", "Module\\Vanityurl\\Controllers\VanityurlController");
   

    $subscriber = new \Module\Vanityurl\Events\VanityEvent();

    \Event::subscribe($subscriber);
    
    //routes for modules should be included in the register method to preceed the base routes 
    
    include __DIR__ . '/../../../routes.php';
    
  }

  public function boot() {
    
    $themeModViewPath = \Atlantis\Helpers\Themes\ThemeTools::getFullThemePath() . '/modules/vanityurl/views/';

    if (is_dir($themeModViewPath)) {
      $this->loadViewsFrom($themeModViewPath, 'vanityurl');
    } else {
      $this->loadViewsFrom(__DIR__ . '/../Views/', 'vanityurl');
    }
      
    $this->loadViewsFrom(__DIR__ . '/../Views/', 'vanityurl-admin');
    
  }

}