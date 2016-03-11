<?php

namespace Module\Api\Controllers\Admin;

use Atlantis\Controllers\Admin\AdminModulesController;

class ApiAdminController extends AdminModulesController {

  public function __construct() {
    parent::__construct(\Config::get('api.setup'));
  } 

  public function getIndex($id = null) {

    return view("api::admin/blank");
  }

}
