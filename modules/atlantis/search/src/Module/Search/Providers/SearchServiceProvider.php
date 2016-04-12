<?php

namespace Module\Search\Providers;

use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider {

  public function register() {

    $this->app->bind("Search", "Module\\\Search\\Controllers\SearchController");
   
    include __DIR__ . '/../../../routes.php';
    
  }

  public function boot() {
    
    $themeModViewPath = \Atlantis\Helpers\Themes\ThemeTools::getFullThemePath() . '/modules/search/views/';

    if (is_dir($themeModViewPath)) {
      $this->loadViewsFrom($themeModViewPath, 'search');
    } else {
      $this->loadViewsFrom(__DIR__ . '/../Views/', 'search');
    }
      
    $this->loadViewsFrom(__DIR__ . '/../Views/', 'search-admin');
    
  }

}