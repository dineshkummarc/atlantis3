<?php

namespace Module\OpenGraph\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class OpenGraphAdminController extends Controller {

  public function __construct() {
  
    $this->config = \Config::get('opengraph.setup');
    
    $this->middleware('Atlantis\Middleware\AdminAuth');
    $this->middleware('Atlantis\Middleware\Permissions:'. $this->config['moduleNamespace'] .','
            . 'Atlantis\Models\Repositories\RoleUsersRepository,'
            . 'Atlantis\Models\Repositories\PermissionsRepository');
  }

  public function getIndex($id = null) {

    return view("opengraph::admin/blank");
  }

}
