<?php

namespace Module\Api\Providers;

class ApiServiceProvider extends \Illuminate\Support\ServiceProvider {

  public function register() {

    $this->app->bind("Api", "Module\\Api\\Controllers\\ApiController");
   
    //routes for modules should be included in the register method to preceed the base routes 
    
    include __DIR__ . '/../../../routes.php';
    
  }

  public function boot() {
    
    /*
    $a = \App::make('Assets');
    
    //  load assests if any
    //$a->registerScripts(["jquery" => ["src" => "jquery.1234324342.", "weight" => 10 ]]);
    
    $this->loadViewsFrom(__DIR__ . '/../Views/', 'blank');
     * 
     */
    
  }

}