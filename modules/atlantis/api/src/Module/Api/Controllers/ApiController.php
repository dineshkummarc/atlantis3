<?php

namespace Module\Api\Controllers;

use App\Http\Controllers\Controller;
use Api\Helper\Json as Json;
use Api\Models\Repositories\ApiUserRepository as Repo;

class ApiController extends Controller {
  

  public function __construct() {
     

  }
  
  public function index() {
    
       //echo Json::encode( Repo::login( "evgeni", "route66" ) );
    
   
  }

}
