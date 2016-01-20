<?php

/*
 *  \Config::get('module.blog') ;
 */


return [
    'name' => 'Blog',
    'author' => 'Atlantis CMS', 
    'version' => '1.0',
    'path' => 'atlantis/blog/src',
    'seedNamespace' => 'Blog\Seed',
    'moduleNamespace' => 'Module\Blog',
    'seeder' => '\Module\Blog\Seed\BlogSeeder',
    'provider' => 'Module\Blog\Providers\BlogServiceProvider',
    'migration' => 'modules/atlantis/blog/src/Module/Blog/Migrations/',
    'extra' => null, 
    'active' => 1
   ];