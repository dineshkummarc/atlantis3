<?php

namespace Module\Blog\Controllers;

use App\Http\Controllers\Controller;
use Module\Blog\Models\Repositories\BlogRepository;

class BlogController extends Controller {
  
  private static $title;

  private $config;
  
  public function __construct() {
     //$this->middleware('auth');

     $this->config = config('blog.config');
    
  }
  
  public static  function getTitle() {
    
       return self::$title;
  }
  
  public function index($aParams = NULL) {
            
        self::$title = "my Cool Blog entry";
    
        //return \View::make('atlantis::shell' ,  [ 'msg'  => "Demo" ] );
    
        return "blog index method " . json_encode($aParams);
  }
  
  /*
   * <div data-pattern-func="module:blog@all"></div>
   */
  public function all() {
    
    $oBlogs = BlogRepository::getAll();

    $aParams = array();

    $aParams['oBlogs'] = $oBlogs;
    $aParams['anchor_url'] = $this->config['anchor_url'];

    return view('blog::blog-list', $aParams);
    
  }

}
