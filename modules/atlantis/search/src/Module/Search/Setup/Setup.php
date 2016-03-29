<?php

return [
    'name' => 'Search',
    'author' => 'Atlantis CMS',
    'version' => '1.0',
    'adminURL' => NULL, // admin/modules/search
    'icon' => 'Search', // http://docteur-abrar.com/wp-content/themes/thunder/admin/stroke-gap-icons/index.html
    'path' => 'atlantis/search/src',
    'seedNamespace' => 'Module\Search\Seed',
    'moduleNamespace' => 'Module\Search',
    'seeder' => 'Module\Search\Seed\SearchSeeder',
    'provider' => 'Module\Search\Providers\SearchServiceProvider',
    'migration' => '',
    'extra' => NULL
];