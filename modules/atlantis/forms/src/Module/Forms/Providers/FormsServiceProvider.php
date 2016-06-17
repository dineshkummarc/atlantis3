<?php

namespace Module\Forms\Providers;

/*
 * Provider: Forms
 * @Atlantis CMS
 * v 1.0
 */

use Illuminate\Support\ServiceProvider;

class FormsServiceProvider extends \Illuminate\Support\ServiceProvider {

  public function register() {

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

    $t = \App::make('Transport');

    /** When form is submitted * */
    $t->registerEvent('form.submitted');

    //routes for modules should be included in the register method to preceed the base routes

    include __DIR__ . '/../../../routes.php';
  }

  public function boot() {
    
    $themeModViewPath = \Atlantis\Helpers\Themes\ThemeTools::getFullThemePath() . '/modules/forms/views/';

    if (is_dir($themeModViewPath)) {
      $this->loadViewsFrom($themeModViewPath, 'forms');
    } else {
      $this->loadViewsFrom(__DIR__ . '/../Views/', 'forms');
    }
      
    $this->loadViewsFrom(__DIR__ . '/../Views/', 'forms-admin');
    
    $this->loadTranslationsFrom(__DIR__ . '/../Languages', "forms");
  }

}
