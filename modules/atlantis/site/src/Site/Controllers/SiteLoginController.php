<?php

namespace Site\Controllers;

use Atlantis\Controllers\SiteLoginController as BaseSiteLoginController; 

class SiteLoginController extends BaseSiteLoginController {
  
  /** change with your routes **/
  public static $route_login = 'site-login';  
  public static $route_after_login = '/';  
  public static $route_after_logout = 'site-login';
  public static $route_logout = 'logout';
  
}
