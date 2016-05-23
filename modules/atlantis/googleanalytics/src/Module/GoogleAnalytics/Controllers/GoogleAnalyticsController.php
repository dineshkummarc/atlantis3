<?php

namespace Module\GoogleAnalytics\Controllers;

use Module\GoogleAnalytics\Models\Repositories\GoogleAnalyticsRepository;

/*
 * Controller: GoogleAnalytics
 * @Atlantis CMS
 * v 1.0
 */

use App\Http\Controllers\Controller;

class GoogleAnalyticsController extends Controller {

  public function __construct() {
    
  }

  public static function getTrackingCode() {   

    $result = GoogleAnalyticsRepository::get(1);

    if ($result->active == "GTM") {

      return \View::make('googleanalytics::gtm', [ 'tag_manager_code' => $result->tag_manager_code]);
    } else {

      return \View::make('googleanalytics::ga', [ 'tracking_code' => $result->tracking_code]);
    }
  }

}
