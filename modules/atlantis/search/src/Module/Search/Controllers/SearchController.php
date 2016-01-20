<?php

namespace Module\Search\Controllers;

use App\Http\Controllers\Controller;

class SearchController extends Controller {
  

  public function index() {
    
      $t = \App::make('Transport'); 
      
      $results = array();
    
      foreach( $t->getEvent('search.providers', true)  as $provider  ){ 
      
              $results[]  =  $provider::get( \Request::input('search', null) );
      }
          
       return \View::make('search::results' ,  [ 'results'  => $results ] );
   
  }

}
