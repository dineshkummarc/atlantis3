<?php

return [
    'name' => 'Blog',
    'author' => 'Atlantis CMS', 
    'version' => '1.5.5',
    'adminURL' => 'admin/modules/blog',
    /**
     * ex. icon icon-Files
     * http://docteur-abrar.com/wp-content/themes/thunder/admin/stroke-gap-icons/index.html
     * 
     * ex. fa fa-beer
     * http://fontawesome.io/icons/
     */
    'icon' => 'icon icon-Blog',
    'path' => 'atlantis/blog/src',
    'seedNamespace' => 'Module\Blog\Seed',
    'moduleNamespace' => 'Module\Blog',
    'seeder' => '\Module\Blog\Seed\BlogSeeder',
    'provider' => 'Module\Blog\Providers\BlogServiceProvider',
    'migration' => 'modules/atlantis/blog/src/Module/Blog/Migrations/',
    'extra' => NULL,
    'description' => 'The Atlantis blog module.'
   ];