<?php

/*
 *  \Config::get('module.blog') ;
 */


return [
    'name' => 'Blog',
    'author' => 'Atlantis CMS', 
    'version' => '1.0',
    'adminURL' => 'admin/modules/blog',
    'icon' => 'Blog', // http://docteur-abrar.com/wp-content/themes/thunder/admin/stroke-gap-icons/index.html
    'path' => 'atlantis/blog/src',
    'seedNamespace' => 'Module\Blog\Seed',
    'moduleNamespace' => 'Module\Blog',
    'seeder' => '\Module\Blog\Seed\BlogSeeder',
    'provider' => 'Module\Blog\Providers\BlogServiceProvider',
    'migration' => 'modules/atlantis/blog/src/Module/Blog/Migrations/',
    'extra' => NULL,
    'description' => 'The Atlantis blog module.'
   ];