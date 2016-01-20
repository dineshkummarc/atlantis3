<?php

return [
    'name' => 'Navis', 
    'author' => 'Atlantis CMS', 
    'version' => '1.0',
    'path' => 'atlantis/navis/src', 
    'seedNamespace' => 'Module\Navis\Seed', 
    'moduleNamespace' => 'Module\Navis',
    'seeder' => '\Module\Navis\Seed\NavisSeeder',
    'provider' => 'Module\Navis\Providers\NavisServiceProvider',
    'migration' => 'modules/atlantis/navis/src/Module/Navis/Migrations/',
    'extra' => NULL, 
    'active' => 1
   ];