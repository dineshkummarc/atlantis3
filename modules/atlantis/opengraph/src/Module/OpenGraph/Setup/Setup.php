<?php


/*
 * Setup: OpenGraph
 * @Atlantis CMS
 * v 1.0
 */

return [
    'name' => 'OpenGraph',
    'author' => 'Atlantis CMS',
    'version' => '1.0',
    'adminURL' => NULL, // admin/modules/opengraph
    'icon' => 'Tag', // http://docteur-abrar.com/wp-content/themes/thunder/admin/stroke-gap-icons/index.html
    'path' => 'atlantis/opengraph/src',
    'moduleNamespace' => 'Module\OpenGraph',
    'seedNamespace' => 'Module\OpenGraph\Seed',    
    'seeder' => '\Module\OpenGraph\Seed\OpenGraphSeeder',
    'provider' => 'Module\OpenGraph\Providers\OpenGraphServiceProvider',
    'migration' => 'modules/atlantis/opengraph/src/Module/OpenGraph/Migrations/',
    'extra' => NULL
   ];
