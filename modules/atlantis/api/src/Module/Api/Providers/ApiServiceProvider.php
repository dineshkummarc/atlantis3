<?php

namespace Module\Api\Providers;

/*
 * Provider: Api
 * @Atlantis CMS
 * v 1.0
 */

use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends \Illuminate\Support\ServiceProvider
{

  public function register()
  {

    $this->mergeConfigFrom(
            __DIR__ . '/../Setup/Setup.php', "api.setup"
    );
    
    $this->mergeConfigFrom(
            __DIR__ . '/../Setup/Config.php', "api.config"
    );
    
    $aConfig = \Config::get('api.config');
  
    if (isset($aConfig['appBind'])) {
      foreach ($aConfig['appBind'] as $key => $value) {
        $this->app->bind($key, $value);
      }
    }

    $subscriber = new \Module\Api\Events\ApiEvent();

    \Event::subscribe($subscriber);   

    //routes for modules should be included in the register method to preceed the base routes

    include __DIR__ . '/../../../routes.php';

  }

  public function boot()
  {    

     $themeModViewPath = \Atlantis\Helpers\Themes\ThemeTools::getFullThemePath() . '/modules/api/views/';

    if (is_dir($themeModViewPath)) {
      $this->loadViewsFrom($themeModViewPath, 'api');
    } else {
      $this->loadViewsFrom(__DIR__ . '/../Views/', 'api');
    }
      
    $this->loadViewsFrom(__DIR__ . '/../Views/', 'api-admin');

  }

}
