<?php

namespace Module\Navis\Providers;

use Illuminate\Support\ServiceProvider;

class NavisServiceProvider extends \Illuminate\Support\ServiceProvider {

  public function register() {

    $this->app->bind("Navis", "Module\\Navis\\Controllers\\NavisController");
   

    //$subscriber = new \Navis\Events\Event();

    //\Event::subscribe($subscriber);
    
    //routes for modules should be included in the register method to preceed the base routes 
    
    include __DIR__ . '/../../../routes.php';
    
  }

  public function boot() {
    
    $a = \App::make('Assets');
    
    $this->loadViewsFrom(__DIR__ . '/../Views/', 'navis');
    
  }

}