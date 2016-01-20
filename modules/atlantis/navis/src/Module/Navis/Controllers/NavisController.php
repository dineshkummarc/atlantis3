<?php

namespace Module\Navis\Controllers;

use App\Http\Controllers\Controller;

class NavisController extends Controller {

  public function __construct() {
    
  }

  public function index() {

    return \View::make('navis::blank', [ 'msg' => "Demo"]);
    
  }
  
  public function getNumber($keyword = null) {

    $t = '';

    try {
      $client = new \SoapClient('http://www.navistechnologies.info/webservices/Narrowcast/Narrowcast.asmx?WSDL', array("trace" => 1, "exception" => true));
      
        $params = array(
            "Account" => "14806",
            "Password" => "qkhj85oeby58j9vuqep0",
            "Keyword" => $keyword
        );      

     $t = $client->GetCampaignTFNumberExact($params);
     
    } catch (SoapFault $e) {

      //echo "<!--".$e->getMessage()."-->";
    }

    if (is_object($t)) {
      
      return preg_replace('/^(\d{1,3})(\d{1,3})(.*$)$/', "($1) $2-$3", $t->GetCampaignTFNumberExactResult);
      
    }
  }

}
