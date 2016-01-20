<?php

return [
    'name' => 'Api', 
    'author' => 'Atlantis CMS', 
    'version' => '1.0',
    'path' => 'atlanits/api/src', 
    'seedNamespace' => 'Module\Api\Seed', 
    'moduleNamespace' => 'Module\Api',
    'seeder' => '\Module\Api\Seed\ApiSeeder', 
    'provider' => 'Module\Api\Providers\ApiServiceProvider',
    'migration' => 'modules/atlantis/api/src/Module/Api/Migrations/',
    'extra' => null, 
    'active' => 1
   ];