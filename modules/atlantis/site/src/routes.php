<?php
  /** Login page route **/
   Route::any('admin' , 'Site\Controllers\LoginController@index'); 
   
  /** Logout page route **/
   Route::get('admin/logout' , 'Site\Controllers\LoginController@logout'); 
   
  /** Admin Dashboard Controller **/ 
  /**
   * Note this call is a little bit different, basically this is the way to call 
   * dynamic methods, however they have to be prefixed with "get<MethodName>"
   */
   Route::controller('admin/dashboard' , 'Site\Controllers\Admin\DashboardController');
   
   /** Route to generate Google compatible xml sitemap **/
   Route::get('sitemap.xml' , 'Site\Controllers\SiteMapController@index');
   
   /** Page with alternate lang specified **/
   Route::get('{lang?}/{page?}', 'Site\Controllers\PageController@index')
           ->where(["lang" => "[a-z]{2}", "page" => ".+"]);

  /** Page with no lang specified **/
   Route::get('{page?}', 'Site\Controllers\PageController@index')
           ->where(["lang" => "[a-z]{2}", "page" => ".+"]);