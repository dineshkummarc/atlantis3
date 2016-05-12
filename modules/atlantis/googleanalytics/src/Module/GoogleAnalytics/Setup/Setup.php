<?php

return [
    'name' => 'Google Analytics', 
    'author' => 'Atlantis CMS', 
    'version' => '1.0',
    'adminURL' => NULL, // admin/modules/googleanalytics
    'icon' => 'ChartUp', // http://docteur-abrar.com/wp-content/themes/thunder/admin/stroke-gap-icons/index.html
    'path' => 'atlantis/googleanalytics/src', 
    'seedNamespace' => 'Module\GoogleAnalytics\Seed', 
    'moduleNamespace' => 'Module\GoogleAnalytics',
    'seeder' => '\Module\GoogleAnalytics\Seed\GoogleAnalyticsSeeder', 
    'provider' => 'Module\GoogleAnalytics\Providers\GoogleAnalyticsServiceProvider',
    'migration' => 'modules/atlantis/googleanalytics/src/Module/GoogleAnalytics/Migrations/',
    'extra' => null,
    'description' => 'Embeds Google Analytics or Google Tag Manager tracking code'
   ];