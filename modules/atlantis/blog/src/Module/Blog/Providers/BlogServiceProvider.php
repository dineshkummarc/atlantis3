<?php

namespace Module\Blog\Providers;

use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider {

  public function register() {

    $this->mergeConfigFrom(
            __DIR__ . '/../Setup/Setup.php', "blog.setup"
    );

    $this->mergeConfigFrom(
            __DIR__ . '/../Setup/Config.php', "blog.config"
    );

    $aConfig = \Config::get('blog.config');

    if (isset($aConfig['appBind'])) {
      foreach ($aConfig['appBind'] as $key => $value) {
        $this->app->bind($key, $value);
      }
    }

    $subscriber = new \Module\Blog\Events\Event();

    \Event::subscribe($subscriber);


    //routes for modules should be included in the register method to preceed the base routes 

    include __DIR__ . '/../../../routes.php';
  }

  public function boot() {

    //$t = \App::make('Transport');

    //$t->setEventValue("search.providers", [ 'search' => \Module\Blog\Models\Search::class, 'weight' => 10]);
    
    $themeModViewPath = \Atlantis\Helpers\Themes\ThemeTools::getFullThemePath() . '/modules/blog/views/';

    if (is_dir($themeModViewPath)) {
      $this->loadViewsFrom($themeModViewPath, 'blog');
    } else {
      $this->loadViewsFrom(__DIR__ . '/../Views/', 'blog');
    }
      
    $this->loadViewsFrom(__DIR__ . '/../Views/', 'blog-admin');
    
    $this->loadTranslationsFrom(__DIR__ . '/../Languages', "blog");
  }

}
