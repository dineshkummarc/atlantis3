<?php

namespace Module\Colorbox\Traits;

/**
 * Helper trait for extending ColorboxController
 */
trait ColorboxTrait {

  public function __call($name, $params) {
   
    /**
     * create controller in site/src/Module/Site/Controllers/Modules/ColorboxController.php
     */
    if (class_exists('Module\Site\Controllers\Modules\ColorboxController')) {

      return \App::make('Module\Site\Controllers\Modules\ColorboxController')->$name($params);
    }
  }

}
