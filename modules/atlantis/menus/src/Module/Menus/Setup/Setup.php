<?php


/*
 * Setup: Menus
 * @Atlantis CMS
 * v 1.0
 */

return [
    'name' => 'Menus',
    'author' => 'Atlantis CMS',
    'version' => '1.0',
    'adminURL' => 'admin/modules/menus', // admin/modules/menus
    'icon' => 'Menu', // http://docteur-abrar.com/wp-content/themes/thunder/admin/stroke-gap-icons/index.html
    'path' => 'atlantis/menus/src',
    'moduleNamespace' => 'Module\Menus',
    'seedNamespace' => 'Module\Menus\Seed',    
    'seeder' => '\Module\Menus\Seed\MenusSeeder',
    'provider' => 'Module\Menus\Providers\MenusServiceProvider',
    'migration' => 'modules/atlantis/menus/src/Module/Menus/Migrations/',
    'extra' => NULL
   ];
