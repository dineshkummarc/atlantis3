<?php

namespace Module\GoogleAnalytics\Providers;

use Illuminate\Support\ServiceProvider;

class GoogleAnalyticsServiceProvider extends ServiceProvider {

  public function register() {

    $this->app->bind("GoogleAnalytics", "Module\\GoogleAnalytics\\Controllers\\GoogleAnalyticsController");
   

    $subscriber = new \Module\GoogleAnalytics\Events\AnalyticsEvent();

    \Event::subscribe($subscriber);
    
    //routes for modules should be included in the register method to preceed the base routes 
    
    include __DIR__ . '/../../../routes.php';
    
  }

  public function boot() {
    
    $themeModViewPath = \Atlantis\Helpers\Themes\ThemeTools::getFullThemePath() . '/modules/googleanalytics/views/';

    if (is_dir($themeModViewPath)) {
      $this->loadViewsFrom($themeModViewPath, 'googleanalytics');
    } else {
      $this->loadViewsFrom(__DIR__ . '/../Views/', 'googleanalytics');
    }
      
    $this->loadViewsFrom(__DIR__ . '/../Views/', 'googleanalytics-admin');
    
  }

}