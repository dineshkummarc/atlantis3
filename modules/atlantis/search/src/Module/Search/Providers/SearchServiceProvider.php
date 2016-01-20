<?php

namespace Module\Search\Providers;

use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends \Illuminate\Support\ServiceProvider {

  public function register() {

    $this->app->bind("Search", "Module\\\Search\\Controllers\SearchController");
   
    include __DIR__ . '/../../../routes.php';
    
  }

  public function boot() {
    
    $this->loadViewsFrom(__DIR__ . '/../Views/', 'search');
    
  }

}