<?php

return [
    'name' => 'Search',
    'author' => 'Atlantis CMS',
    'version' => '1.0',
    'path' => 'atlantis/search/src',
    'seedNamespace' => 'Module\Search\Seed',
    'moduleNamespace' => 'Module\Search',
    'seeder' => 'Module\Search\Seed\SearchSeeder',
    'provider' => 'Module\Search\Providers\SearchServiceProvider',
    'migration' => '',
    'extra' => null,
    'active' => 1
];