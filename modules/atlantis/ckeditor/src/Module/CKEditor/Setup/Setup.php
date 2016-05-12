<?php

/*
 * Setup: CKEditor
 * @Atlantis CMS
 * v 1.0
 */

return [
    'name' => 'CKEditor',
    'author' => 'Atlantis CMS',
    'version' => '1.0',
    'adminURL' => NULL, // admin/modules/ckeditor
    'icon' => 'Pencil', // http://docteur-abrar.com/wp-content/themes/thunder/admin/stroke-gap-icons/index.html
    'path' => 'atlantis/ckeditor/src',
    'moduleNamespace' => 'Module\CKEditor',
    'seedNamespace' => 'Module\CKEditor\Seed',
    'seeder' => '\Module\CKEditor\Seed\CKEditorSeeder',
    'provider' => 'Module\CKEditor\Providers\CKEditorServiceProvider',
    'migration' => 'modules/atlantis/ckeditor/src/Module/CKEditor/Migrations/',
    'extra' => [
        /**
         * only for editor modules like CKEditor, Redaktor...
         */
        'type' => 'editor',
        'editorClass' => 'Module\CKEditor\CKEditorBuilder'
    ],
    'description' => 'The famous WYSIWYG editor.'
];
