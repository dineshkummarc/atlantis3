<?php


/*
 * Setup: Api
 * @Atlantis CMS
 * v 1.0
 */

return [
    'name' => 'Api',
    'author' => 'Atlantis CMS',
    'version' => '1.0',
    'path' => 'atlantis/api/src',
    'moduleNamespace' => 'Module\Api',
    'seedNamespace' => 'Module\Api\Seed',    
    'seeder' => '\Module\Api\Seed\ApiSeeder',
    'provider' => 'Module\Api\Providers\ApiServiceProvider',
    'migration' => 'modules/atlantis/api/src/Module/Api/Migrations/',
    'extra' => null,
    'active' => 1
   ];
