<?php

namespace Module\Forms\Controllers\Admin;

use Atlantis\Controllers\Admin\AdminModulesController;
use Module\Forms\Models\Repositories\FormsRepository;
use Illuminate\Http\Request;
use Module\Forms\Helpers\Builder as FormBuilder;
use Module\Forms\Helpers\Captcha as CaptchaHelper;

class FormsAdminController extends AdminModulesController {

  public function __construct() {
    parent::__construct(\Config::get('forms.setup'));
  } 

  /*
   * Show list
   * 
   * admin/modules/forms
   * 
   * Responds to requests to GET
   */

  public function getIndex() {

    $oModels = FormsRepository::getAll();

    $aParams = array();

    $aParams['oModels'] = $oModels;

    return view('forms-admin::admin/list', $aParams);
  }

  /*
   * Show add view
   * 
   * admin/modules/forms/add
   * 
   * Responds to requests to GET
   */

  public function getAdd() {

    $aCaptchas = CaptchaHelper::getAll($this->getModuleConfig());

    $aParams = array();
    $aParams['aCaptcha'] = $this->getCaptchasForSelect($aCaptchas);

    return view('forms-admin::admin/add', $aParams);
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

      $aCaptchas = CaptchaHelper::getAll($this->getModuleConfig());

      $postData = $request->all();
      $postData['captcha_namespace'] = $aCaptchas[$request->get('select_captcha')]['namespace'];
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

  public function getEdit($id = NULL) {

    $oModel = FormsRepository::get($id);

    $aCaptchas = CaptchaHelper::getAll($this->getModuleConfig());

    $captcha_select = NULL;

    foreach ($aCaptchas as $k => $captcha) {
      if ($oModel->captcha_namespace == $captcha['namespace']) {
        $captcha_select = $k;
      }
    }

    $aParams = array();

    $aParams['oModel'] = $oModel;
    $aParams['aCaptcha'] = $this->getCaptchasForSelect($aCaptchas);
    $aParams['captcha_select'] = $captcha_select;

    return view('forms-admin::admin/edit', $aParams);
  }

  /*
   * Edit blog entry
   * 
   * admin/modules/forms/edit/{id}
   * 
   * Responds to requests to POST
   */

  public function postEdit($id = NULL, Request $request) {

    $oModel = new FormsRepository();

    $validator = $oModel->validationEdit($request->all());

    if (!$validator->fails()) {

      $aData = $request->all();

      $aCaptchas = CaptchaHelper::getAll($this->getModuleConfig());
      $aData['captcha_namespace'] = $aCaptchas[$request->get('select_captcha')]['namespace'];

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

      $aData['items'] = FormBuilder::getPostItems();
      //dd($aData);
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

  public function getDelete($id = NULL) {

    if (FormsRepository::deleteEntry($id)) {
      return redirect('admin/modules/forms')->with('success', 'Success');
    } else {
      return redirect('admin/modules/forms')->with('error', 'Invalid ID');
    }
  }

  public function getExportCsv($id = NULL) {

    $model = \Module\Forms\Models\Repositories\FormsResultsRepository::getResults($id);

    \Module\Forms\Helpers\Export::toCSV($model, $id);    
    
  }

  private function getCaptchasForSelect($aCaptchas) {

    $aSelect = array();

    foreach ($aCaptchas as $k => $captcha) {
      $aSelect[$k] = $captcha['name'];
    }

    return $aSelect;
  }

}
