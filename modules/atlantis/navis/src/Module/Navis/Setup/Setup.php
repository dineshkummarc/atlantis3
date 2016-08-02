<?php

return [
    'name' => 'Navis', 
    'author' => 'Atlantis CMS', 
    'version' => '1.2',
    'adminURL' => NULL, // admin/modules/navis
    /**
     * ex. icon icon-Files
     * http://docteur-abrar.com/wp-content/themes/thunder/admin/stroke-gap-icons/index.html
     * 
     * ex. fa fa-beer
     * http://fontawesome.io/icons/
     */
    'icon' => 'icon icon-Goto',
    'path' => 'atlantis/navis/src',
    'seedNamespace' => 'Module\Navis\Seed', 
    'moduleNamespace' => 'Module\Navis',
    'seeder' => '\Module\Navis\Seed\NavisSeeder',
    'provider' => 'Module\Navis\Providers\NavisServiceProvider',
    'migration' => 'modules/atlantis/navis/src/Module/Navis/Migrations/',
    'extra' => NULL,
    'description' => 'Generates proper codes for communication with https://www.thenavisway.com/'
   ];