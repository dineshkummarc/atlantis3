<?php

namespace Site\Providers;


class SiteServiceProvider extends \Atlantis\Providers\AtlantisServiceProvider {
  
  public function boot() {
    
        /**
         * Include Site Routes
        */
        include __DIR__.'/../../routes.php';
    
  }
  
  public function register() {
    //parent::register();
  }
  
}