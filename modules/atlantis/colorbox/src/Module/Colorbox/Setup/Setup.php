<?php


/*
 * Setup: Colorbox
 * @Atlantis CMS
 * v 1.0
 */

return [
    'name' => 'Colorbox',
    'author' => 'Atlantis CMS',
    'version' => '1.0',
    'adminURL' => 'admin/modules/colorbox', // admin/modules/colorbox
    'icon' => 'Picture', // http://docteur-abrar.com/wp-content/themes/thunder/admin/stroke-gap-icons/index.html
    'path' => 'atlantis/colorbox/src',
    'moduleNamespace' => 'Module\Colorbox',
    'seedNamespace' => 'Module\Colorbox\Seed',    
    'seeder' => '\Module\Colorbox\Seed\ColorboxSeeder',
    'provider' => 'Module\Colorbox\Providers\ColorboxServiceProvider',
    'migration' => 'modules/atlantis/colorbox/src/Module/Colorbox/Migrations/',
    'extra' => NULL,
    'description' => ''
   ];
