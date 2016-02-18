<?php

namespace Module\Forms\Controllers;

use Module\Forms\Models\Repositories\FormsRepository;
use Module\Forms\Models\Repositories\FormsItemsRepository;

/*
 * Controller: Forms
 * @Atlantis CMS
 * v 1.0
 */
use App\Http\Controllers\Controller;

class FormsController extends Controller {

  public function __construct() {
    
  }

  public function index() {

    return \View::make('forms::admin/blank', [ 'msg' => "Demo"]);
  }

  /*
   * <div data-pattern-func="module:forms@build-1"></div>
   */

  public function build($aParams = NULL) {
    
    if (isset($aParams[0])) {

      $form_id = $aParams[0];

      $form = FormsRepository::get($form_id);

      if ($form != NULL) {

        $formItems = FormsItemsRepository::getItems($form_id);
        
        $aParams = array();
        $aParams['form'] = $form;
        $aParams['escaped_name'] = strtolower(str_replace(" ", "-", $form->name));
        $aParams['url'] = request()->url();
        
        if (request()->method() == \App\Http\Requests\Request::METHOD_POST && request()->get('form_id') == $form->id) {
          dd(request()->all());
        }
              
        return view('forms::form-builder', $aParams);
      } else {
        abort(404, "form with ID: " . $form_id . " not found");
      }
    } else {
      abort(404, "form ID is missing");
    }
  }

}
