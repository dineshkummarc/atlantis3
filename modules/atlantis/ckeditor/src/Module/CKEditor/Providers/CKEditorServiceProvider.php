<?php

namespace Module\CKEditor\Providers;

/*
 * Provider: CKEditor
 * @Atlantis CMS
 * v 1.0
 */

use Illuminate\Support\ServiceProvider;

class CKEditorServiceProvider extends \Illuminate\Support\ServiceProvider
{

  public function register()
  {

    $this->mergeConfigFrom(
            __DIR__ . '/../Setup/Setup.php', "ckeditor.setup"
    );
    
    $this->mergeConfigFrom(
            __DIR__ . '/../Setup/Config.php', "ckeditor.config"
    );
    
    $aConfig = \Config::get('ckeditor.config');
  
    if (isset($aConfig['appBind'])) {
      foreach ($aConfig['appBind'] as $key => $value) {
        $this->app->bind($key, $value);
      }
    }

    //$subscriber = new \Module\CKEditor\Events\CKEditorEvent();

    //\Event::subscribe($subscriber);   

    //routes for modules should be included in the register method to preceed the base routes

    include __DIR__ . '/../../../routes.php';

  }

  public function boot()
  {

    //$a = \App::make('Assets');

    //  load assests if any
    //$a->registerScripts(["jquery" => ["src" => "jquery...", "weight" => 10 ]]);

    /**
     * To register search provider
     *
     * $t = \App::make('Transport');
     *
     *  $t->setEventValue("search.providers", [  'search' => 'Module\CKEditor\Models\Search' , 'weight' => 10] );
     */

    $this->loadViewsFrom(__DIR__ . '/../Views/', 'ckeditor');

  }

}
