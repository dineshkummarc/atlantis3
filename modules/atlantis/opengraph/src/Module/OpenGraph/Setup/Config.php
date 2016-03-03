<?php

/*
 * Config: OpenGraph
 * @Atlantis CMS
 * v 1.0
 */

return [
   /*
    * $this->app->bind("Module\OpenGraph", "Atlantis\\OpenGraph\\Controllers\\OpenGraphController");
    * 
    * 'appBind' => [
    *    'Module\OpenGraph' => 'Module\\OpenGraph\\Controllers\\OpenGraphController'
    *],
    *[
    *    'Module\OpenGraph\CustomController' => 'Module\\OpenGraph\\Controllers\\CustomController'
    *]
    */
    'appBind' => [
        'Module\OpenGraph' => 'Module\\OpenGraph\\Controllers\\OpenGraphController'
    ]
   ];
