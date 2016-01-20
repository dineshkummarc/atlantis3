<?php

namespace Module\GoogleAnalytics\Providers;

use Illuminate\Support\ServiceProvider;

class GoogleAnalyticsServiceProvider extends \Illuminate\Support\ServiceProvider {

  public function register() {

    $this->app->bind("GoogleAnalytics", "Module\\GoogleAnalytics\\Controllers\\GoogleAnalyticsController");
   

    $subscriber = new \Module\GoogleAnalytics\Events\AnalyticsEvent();

    \Event::subscribe($subscriber);
    
    //routes for modules should be included in the register method to preceed the base routes 
    
    include __DIR__ . '/../../../routes.php';
    
  }

  public function boot() {
    
    $this->loadViewsFrom(__DIR__ . '/../Views/', 'googleanalytics');
    
  }

}