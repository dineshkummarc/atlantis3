<?php

 namespace Module\OpenGraph\Controllers;

/*
 * Controller: OpenGraph
 * @Atlantis CMS
 * v 1.0
 */

use App\Http\Controllers\Controller;

class OpenGraphController extends Controller
{


  public function __construct()
  {


  }

  public function index()
  {

       return \View::make('opengraph::admin/blank' ,  [ 'msg'  => "Demo" ] );

  }

}
