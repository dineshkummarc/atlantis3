<?php

namespace Module\Blog\Controllers;

use App\Http\Controllers\Controller;

class BlogController extends Controller {
  
  private static $title;

  public function __construct() {
     //$this->middleware('auth');

  }
  
  public static  function getTitle() {
    
       return self::$title;
  }

  public function index($aParams = NULL) {
            
        self::$title = "my Cool Blog entry";
    
        //return \View::make('atlantis::shell' ,  [ 'msg'  => "Demo" ] );
    
        return "blog index method " . json_encode($aParams);
  }

}
