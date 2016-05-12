<?php

return [
    'name' => 'Vanity Url', 
    'author' => 'Atlantis CMS', 
    'version' => '1.0',
    'adminURL' => NULL, // admin/modules/vanityurl
    'icon' => 'Layers', // http://docteur-abrar.com/wp-content/themes/thunder/admin/stroke-gap-icons/index.html
    'path' => 'atlantis/vanityurl/src', 
    'seedNamespace' => 'Module\Vanityurl\Seed', 
    'moduleNamespace' => 'Module\Vanityurl',
    'seeder' => '\Module\Vanityurl\Seed\VanityurlSeeder', 
    'provider' => 'Module\Vanityurl\Providers\VanityurlServiceProvider',
    'migration' => 'modules/atlantis/vanityurl/src/Module/Vanityurl/Migrations/',
    'extra' => NULL,
    'description' => 'Enables you to create and manage custom page redirects'
   ];