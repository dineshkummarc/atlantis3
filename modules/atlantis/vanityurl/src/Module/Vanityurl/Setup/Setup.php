<?php


/*
 * Setup: VanityUrl
 * @Atlantis CMS
 * v 1.0
 */

return [
    'name' => 'Vanity Url',
    'author' => 'Atlantis CMS',
    'version' => '1.0',
    'adminURL' => 'admin/modules/vanityurl', // 
    'icon' => 'Layers', // http://docteur-abrar.com/wp-content/themes/thunder/admin/stroke-gap-icons/index.html
    'path' => 'atlantis/vanityurl/src',
    'moduleNamespace' => 'Module\VanityUrl',
    'seedNamespace' => 'Module\VanityUrl\Seed',    
    'seeder' => '\Module\VanityUrl\Seed\VanityUrlSeeder',
    'provider' => 'Module\VanityUrl\Providers\VanityUrlServiceProvider',
    'migration' => 'modules/atlantis/vanityurl/src/Module/VanityUrl/Migrations/',
    'extra' => NULL,
    'description' => ''
   ];
