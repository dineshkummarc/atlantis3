<?php

namespace Module\Forms\Controllers;

use Module\Forms\Models\Repositories\FormsRepository;
use Module\Forms\Models\Repositories\FormsItemsRepository;
use Module\Forms\Helpers\Builder as FormsBuilder;
use Module\Forms\Helpers\Validator as FormsValidator;
/**
 * Controller: Forms
 * @Atlantis CMS
 * v 1.0
 */
use App\Http\Controllers\Controller;

class FormsController extends Controller {

  public function __construct() {
    
  }

  /**
   * <div data-pattern-func="module:forms@build-1"></div>
   */
  public function build($aParams = NULL) {

    if (isset($aParams[0])) {

      $form_id = $aParams[0];

      $form = FormsRepository::get($form_id);

      if ($form != NULL) {

        $formItems = FormsItemsRepository::getItems($form_id);

        $aData = array();
        $aData['form'] = $form;
        $aData['escaped_name'] = strtolower(str_replace(" ", "-", $form->name));
        $aData['url'] = request()->url();
        $aData['items'] = FormsBuilder::buildItems($formItems);

        if (request()->method() == \App\Http\Requests\Request::METHOD_POST && request()->get('form_id') == $form->id) {
          //dd(request()->all());
          $validator = new FormsValidator($formItems);
          $validator->make(request()->all());

          if (!$validator->fails()) {
            //save post data in DB 
            request()->session()->flash('success', $form->message);
            return redirect()->back()->send();
          } else {
            return redirect()->back()->withErrors($validator->getErrors())->withInput()->send();
            //return redirect()->back()->withErrors($validator->getErrors())->withInput();
          }
        }

        return view('forms::form-builder', $aData);
      } else {
        abort(404, "form with ID: " . $form_id . " not found");
      }
    } else {
      abort(404, "form ID is missing");
    }
  }

}
