<?php

return [
    'name' => 'Vanity Url', 
    'author' => 'Atlantis CMS', 
    'version' => '1.0',
    'path' => 'atlantis/vanityurl/src', 
    'seedNamespace' => 'Module\Vanityurl\Seed', 
    'moduleNamespace' => 'Module\Vanityurl',
    'seeder' => '\Module\Vanityurl\Seed\VanityurlSeeder', 
    'provider' => 'Module\Vanityurl\Providers\VanityurlServiceProvider',
    'migration' => 'modules/atlantis/vanityurl/src/Module/Vanityurl/Migrations/',
    'extra' => null, 
    'active' => 1
   ];