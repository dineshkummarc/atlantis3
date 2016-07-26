<?php

namespace Module\VanityUrl\Controllers;

/*
 * Controller: VanityUrl
 * @Atlantis CMS
 * v 1.0
 */

use App\Http\Controllers\Controller;
use Module\VanityUrl\Models\Repositories\VanityUrlRepository;

class VanityUrlController extends Controller {

  public function __construct() {
    
  }

  public function redirect($path) {

    $result = VanityUrlRepository::findSourceURL($path);
    
    if ($result != NULL) {
      return redirect($result->dest_url)->send();
    }
  }

}
