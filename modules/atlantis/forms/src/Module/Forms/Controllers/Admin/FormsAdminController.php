<?php

namespace Module\Forms\Controllers\Admin;

use App\Http\Controllers\Controller;
use Module\Forms\Models\Repositories\FormsRepository;
use Illuminate\Http\Request;
use Module\Forms\Helpers\Builder as FormBuilder;

class FormsAdminController extends Controller {

  public function __construct() {

    $this->config = \Config::get('forms.setup');

    $this->middleware('Atlantis\Middleware\AdminAuth');
    $this->middleware('Atlantis\Middleware\Permissions:' . $this->config['moduleNamespace'] . ','
            . 'Atlantis\Models\Repositories\RoleUsersRepository,'
            . 'Atlantis\Models\Repositories\PermissionsRepository');
  }
  
  /*
   * Show list
   * 
   * admin/modules/forms
   * 
   * Responds to requests to GET
   */

  public function getIndex($id = null) {
    $oModels = FormsRepository::getAll();

    $aParams = array();

    $aParams['oModels'] = $oModels;

    return view('forms::admin/list', $aParams);
  }

  /*
   * Show add view
   * 
   * admin/modules/forms/add
   * 
   * Responds to requests to GET
   */

  public function getAdd() {

    $aParams = array();

    return view('forms::admin/add', $aParams);
  }

  /*
   * Save new entry
   * 
   * admin/modules/forms/add
   * 
   * Responds to requests to POST 
   */

  public function postAdd(Request $request) {

    $modelDB = new FormsRepository();

    $validator = $modelDB->validationCreate($request->all());

    if (!$validator->fails()) {

      $postData = $request->all();
      $postData['items'] = FormBuilder::getPostItems();
      
      $modelDB->add($postData);

      return redirect('admin/modules/forms')->with('success', 'Success');
    } else {
      return redirect('admin/modules/forms/add')->withErrors($validator)->withInput();
    }
  }

  /*
   * Show edit view
   * 
   * admin/modules/forms/edit/{id}
   * 
   * Responds to requests to GET
   */

  public function getEdit($id = null) {

    $oModel = FormsRepository::get($id);

    $aParams = array();
    
    $aParams['oModel'] = $oModel;

    return view('forms::admin/edit', $aParams);
  }

  /*
   * Edit blog entry
   * 
   * admin/modules/forms/edit/{id}
   * 
   * Responds to requests to POST
   */

  public function postEdit($id = null, Request $request) {

    $oModel = new FormsRepository();

    $validator = $oModel->validationEdit($request->all());

    if (!$validator->fails()) {
      
      $aData = $request->all();
      
      if (!isset($aData['captcha'])) {
        $aData['captcha'] = 0;
      }
      
      if (!isset($aData['ga'])) {
        $aData['ga'] = 0;
      }
      
      if (!isset($aData['use_custom_form'])) {
        $aData['use_custom_form'] = 0;
      }
      
      if (!isset($aData['email_check'])) {
        $aData['email_check'] = 0;
      }

      $aData = $request->all();
      $aData['items'] = FormBuilder::getPostItems();
      
      $oModel->edit($id, $aData);

      return redirect('admin/modules/forms')->with('success', 'Success');
    } else {
      return redirect('admin/modules/forms/edit/' . $id)->withErrors($validator)->withInput();
    }
  }

  /*
   * Delete entry
   * 
   * admin/modules/forms/delete/{id}
   * 
   * Responds to requests to GET
   */

  public function getDelete($id = null) {

    if (FormsRepository::deleteEntry($id)) {
      return redirect('admin/modules/forms')->with('success', 'Success');
    } else {
      return redirect('admin/modules/forms')->with('error', 'Invalid ID');
    }
  }

}
