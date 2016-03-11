<?php

namespace Module\OpenGraph\Controllers\Admin;

use Atlantis\Controllers\Admin\AdminModulesController;

class OpenGraphAdminController extends AdminModulesController {

  public function __construct() {
    parent::__construct(\Config::get('opengraph.setup'));
  }  

  public function getIndex($id = null) {

    return view("opengraph::admin/blank");
  }

}
