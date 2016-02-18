<?php

namespace Module\Forms\Providers;

/*
 * Provider: Forms
 * @Atlantis CMS
 * v 1.0
 */

use Illuminate\Support\ServiceProvider;

class FormsServiceProvider extends \Illuminate\Support\ServiceProvider
{

  public function register()
  {

    $this->mergeConfigFrom(
            __DIR__ . '/../Setup/Setup.php', "forms.setup"
    );
    
    $this->mergeConfigFrom(
            __DIR__ . '/../Setup/Config.php', "forms.config"
    );
    
    $aConfig = \Config::get('forms.config');
  
    if (isset($aConfig['appBind'])) {
      foreach ($aConfig['appBind'] as $key => $value) {
        $this->app->bind($key, $value);
      }
    }

    $subscriber = new \Module\Forms\Events\FormsEvent();

    \Event::subscribe($subscriber);   

    //routes for modules should be included in the register method to preceed the base routes

    include __DIR__ . '/../../../routes.php';

  }

  public function boot()
  {

    $a = \App::make('Assets');

    //  load assests if any
    //$a->registerScripts(["jquery" => ["src" => "jquery...", "weight" => 10 ]]);

    /**
     * To register search provider
     *
     * $t = \App::make('Transport');
     *
     *  $t->setEventValue("search.providers", [  'search' => 'Module\Forms\Models\Search' , 'weight' => 10] );
     */

    $this->loadViewsFrom(__DIR__ . '/../Views/', 'forms');

  }

}
