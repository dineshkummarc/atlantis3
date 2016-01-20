<?php

return [
    'name' => 'Google Analytics', 
    'author' => 'Atlantis CMS', 
    'version' => '1.0',
    'path' => 'atlantis/googleanalytics/src', 
    'seedNamespace' => 'Module\GoogleAnalytics\Seed', 
    'moduleNamespace' => 'Module\GoogleAnalytics',
    'seeder' => '\Module\GoogleAnalytics\Seed\GoogleAnalyticsSeeder', 
    'provider' => 'Module\GoogleAnalytics\Providers\GoogleAnalyticsServiceProvider',
    'migration' => 'modules/atlantis/googleanalytics/src/Module/GoogleAnalytics/Migrations/',
    'extra' => null, 
    'active' => 1
   ];