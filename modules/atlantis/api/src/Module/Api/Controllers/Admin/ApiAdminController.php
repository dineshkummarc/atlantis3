<?php

namespace Module\Api\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ApiAdminController extends Controller {

  public function __construct() {
  
    $this->config = \Config::get('api.setup');
    
    $this->middleware('Atlantis\Middleware\AdminAuth');
    $this->middleware('Atlantis\Middleware\Permissions:'. $this->config['moduleNamespace'] .','
            . 'Atlantis\Models\Repositories\RoleUsersRepository,'
            . 'Atlantis\Models\Repositories\PermissionsRepository');
  }

  public function getIndex($id = null) {

    return view("api::admin/blank");
  }

}
