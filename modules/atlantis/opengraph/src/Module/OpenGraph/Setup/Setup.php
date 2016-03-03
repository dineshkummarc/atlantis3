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
    'path' => 'atlantis/opengraph/src',
    'moduleNamespace' => 'Module\OpenGraph',
    'seedNamespace' => 'Module\OpenGraph\Seed',    
    'seeder' => '\Module\OpenGraph\Seed\OpenGraphSeeder',
    'provider' => 'Module\OpenGraph\Providers\OpenGraphServiceProvider',
    'migration' => 'modules/atlantis/opengraph/src/Module/OpenGraph/Migrations/',
    'extra' => null,
    'active' => 1
   ];
