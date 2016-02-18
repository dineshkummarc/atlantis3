<?php


/*
 * Setup: Forms
 * @Atlantis CMS
 * v 1.0
 */

return [
    'name' => 'Forms',
    'author' => 'Atlantis CMS',
    'version' => '1.0',
    'path' => 'atlantis/forms/src',
    'moduleNamespace' => 'Module\Forms',
    'seedNamespace' => 'Module\Forms\Seed',    
    'seeder' => '\Module\Forms\Seed\FormsSeeder',
    'provider' => 'Module\Forms\Providers\FormsServiceProvider',
    'migration' => 'modules/atlantis/forms/src/Module/Forms/Migrations/',
    'extra' => null,
    'active' => 1
   ];
