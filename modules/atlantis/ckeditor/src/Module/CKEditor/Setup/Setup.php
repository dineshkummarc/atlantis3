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
    'path' => 'atlantis/ckeditor/src',
    'moduleNamespace' => 'Module\CKEditor',
    'seedNamespace' => 'Module\CKEditor\Seed',
    'seeder' => '\Module\CKEditor\Seed\CKEditorSeeder',
    'provider' => 'Module\CKEditor\Providers\CKEditorServiceProvider',
    'migration' => 'modules/atlantis/ckeditor/src/Module/CKEditor/Migrations/',
    'extra' => null,
    'active' => 1,
    /**
     * only for editor modules like CKEditor, Redaktor...
     */
    'type' => 'editor',
    'editorClass' => 'Module\CKEditor\CKEditorBuilder'
];
