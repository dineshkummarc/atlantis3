<?php

/*
 * Config: Api
 * @Atlantis CMS
 * v 1.0
 */

return [
   /*
    * $this->app->bind("Module\Api", "Atlantis\\Api\\Controllers\\ApiController");
    * 
    * 'appBind' => [
    *    'Module\Api' => 'Module\\Api\\Controllers\\ApiController'
    *],
    *[
    *    'Module\Api\CustomController' => 'Module\\Api\\Controllers\\CustomController'
    *]
    */
    'appBind' => [
        'Module\Api' => 'Module\\Api\\Controllers\\ApiController'
    ]
   ];
