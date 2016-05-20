<?php

namespace Module\Colorbox\Providers;

/*
 * Provider: Colorbox
 * @Atlantis CMS
 * v 1.0
 */

class ColorboxServiceProvider extends \Illuminate\Support\ServiceProvider
{

  public function register()
  {

    $this->mergeConfigFrom(
            __DIR__ . '/../Setup/Setup.php', "colorbox.setup"
    );
    
    $this->mergeConfigFrom(
            __DIR__ . '/../Setup/Config.php', "colorbox.config"
    );
    
    $aConfig = \Config::get('colorbox.config');
  
    if (isset($aConfig['appBind'])) {
      foreach ($aConfig['appBind'] as $key => $value) {
        $this->app->bind($key, $value);
      }
    }

    $subscriber = new \Module\Colorbox\Events\ColorboxEvent();

    \Event::subscribe($subscriber);   

    //routes for modules should be included in the register method to preceed the base routes

    include __DIR__ . '/../../../routes.php';

  }

  public function boot()
  {

    //$a = \App::make('Assets');

    //  load assests if any
    //$a->registerScripts(['jquery' => ['src' => \Html::script('https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js'), 'weight' => 2]]);

    /**
     * To register search provider
     *
     * $t = \App::make('Transport');
     *
     *  $t->setEventValue("search.providers", [  'search' => 'Module\Colorbox\Models\Search' , 'weight' => 10] );
     */

     
    $themeModViewPath = \Atlantis\Helpers\Themes\ThemeTools::getFullThemePath() . '/modules/colorbox/views/';

    if (is_dir($themeModViewPath)) {
      $this->loadViewsFrom($themeModViewPath, 'colorbox');
    } else {
      $this->loadViewsFrom(__DIR__ . '/../Views/', 'colorbox');
    }
    
    $this->loadViewsFrom(__DIR__ . '/../Views/', 'colorbox-admin');
    
    /**
    *  call this with trans('colorbox::file.key');
    */      
    $this->loadTranslationsFrom(__DIR__ . '/../Languages', "colorbox");

  }

}
