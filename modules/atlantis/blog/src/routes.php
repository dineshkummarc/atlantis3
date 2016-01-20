<?php

Route::controller('admin/modules/blog' , 'Module\Blog\Controllers\Admin\BlogAdminController');

Route::get('blog', 'Module\Blog\Controllers\BlogController@index');