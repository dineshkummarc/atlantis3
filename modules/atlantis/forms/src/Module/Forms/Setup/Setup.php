<?php

/*
 * Setup: Forms
 * @Atlantis CMS
 * v 1.3
 */

return [
    'name' => 'Forms',
    'author' => 'Atlantis CMS',
    'version' => '1.3',
    'adminURL' => 'admin/modules/forms', // admin/modules/forms
    'icon' => 'Files', // http://docteur-abrar.com/wp-content/themes/thunder/admin/stroke-gap-icons/index.html
    'path' => 'atlantis/forms/src',
    'moduleNamespace' => 'Module\Forms',
    'seedNamespace' => 'Module\Forms\Seed',    
    'seeder' => '\Module\Forms\Seed\FormsSeeder',
    'provider' => 'Module\Forms\Providers\FormsServiceProvider',
    'migration' => 'modules/atlantis/forms/src/Module/Forms/Migrations/',
    'extra' => NULL,
    'description' => 'Module to help you generate web forms and embed them into pages.'
   ];
