<?php

namespace Module\Vanityurl\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;

class VanityurlController extends Controller {
  
  public function redirect($path) {
    
      $model = new \Module\Vanityurl\Models\Vanity(); 
      
      $result = $model::where("source_url" , "=" , $path)->first(); 
      
      if ( $result ) {

           return Redirect( $result->dest_url )->send();
           
      }
      
  }


}
