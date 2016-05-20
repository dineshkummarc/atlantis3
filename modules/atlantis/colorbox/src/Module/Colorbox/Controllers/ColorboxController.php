<?php

 namespace Module\Colorbox\Controllers;

/*
 * Controller: Colorbox
 * @Atlantis CMS
 * v 1.0
 */

use App\Http\Controllers\Controller;

class ColorboxController extends Controller
{


  public function __construct()
  {


  }

  public function index()
  {

       return \View::make('colorbox::blank' ,  [ 'msg'  => "Demo" ] );

  }

}
