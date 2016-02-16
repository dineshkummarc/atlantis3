<?php

 namespace Module\Api\Controllers;

/*
 * Controller: Api
 * @Atlantis CMS
 * v 1.0
 */

use App\Http\Controllers\Controller;

class ApiController extends Controller
{


  public function __construct()
  {


  }

  public function index()
  {

       return \View::make('api::admin/blank' ,  [ 'msg'  => "Demo" ] );

  }

}
