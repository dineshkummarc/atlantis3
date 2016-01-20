<?php

namespace Module\GoogleAnalytics\Controllers;

use App\Http\Controllers\Controller;

class GoogleAnalyticsController extends Controller {
  

  public function __construct() {
     

  }
  
  public function index() {
          
       return \View::make('googleanalytics::blank' ,  [ 'msg'  => "Demo" ] );
    
   
  }
  
  public static function getTrackingCode() {
    
       $model = new \Module\GoogleAnalytics\Models\GoogleAnalytics(); 
       
       $result =  $model::find(1);
       
       if ( $result->active == "GTM" ) {
         
         return \View::make('googleanalytics::gtm', [ 'tag_manager_code' => $result->tag_manager_code ]);
         
       }
       else {
         
         return \View::make('googleanalytics::ga', [ 'tracking_code' => $result->tracking_code ]);
       }
       
    
  }
  

}