<?php

return [
    'name' => 'Navis', 
    'author' => 'Atlantis CMS', 
    'version' => '1.1',
    'adminURL' => NULL, // admin/modules/navis
    'icon' => 'Goto', // http://docteur-abrar.com/wp-content/themes/thunder/admin/stroke-gap-icons/index.html
    'path' => 'atlantis/navis/src',
    'seedNamespace' => 'Module\Navis\Seed', 
    'moduleNamespace' => 'Module\Navis',
    'seeder' => '\Module\Navis\Seed\NavisSeeder',
    'provider' => 'Module\Navis\Providers\NavisServiceProvider',
    'migration' => 'modules/atlantis/navis/src/Module/Navis/Migrations/',
    'extra' => NULL,
    'description' => 'Generates proper codes for communication with https://www.thenavisway.com/'
   ];