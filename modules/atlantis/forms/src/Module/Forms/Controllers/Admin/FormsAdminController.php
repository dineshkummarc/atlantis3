<?php

namespace Module\Forms\Controllers\Admin;

use Atlantis\Controllers\Admin\AdminModulesController;
use Module\Forms\Models\Repositories\FormsRepository;
use Illuminate\Http\Request;
use Module\Forms\Helpers\Builder as FormBuilder;
use Module\Forms\Helpers\Captcha as CaptchaHelper;
use Module\Forms\Models\Repositories\FormsItemsRepository;
use Module\Forms\Models\Repositories\FormsConfigRepository;

class FormsAdminController extends AdminModulesController {

  public function __construct() {
    parent::__construct(\Config::get('forms.setup'));
  }

  /**
   * Show list
   * 
   * admin/modules/forms
   * 
   * Responds to requests to GET
   */
  public function getIndex() {

    $aData = array();

    if (\Session::get('info') != NULL) {
      $aData['msgInfo'] = \Session::get('info');
    }

    if (\Session::get('success') != NULL) {
      $aData['msgSuccess'] = \Session::get('success');
    }

    if (\Session::get('error') != NULL) {
      $aData['msgError'] = \Session::get('error');
    }

    $oModels = FormsRepository::getAll();
    
    $aData['config'] = FormsConfigRepository::getConfig();
   
    $aData['oModels'] = $oModels;

    return view('forms-admin::admin/list', $aData);
  }

  /**
   * Show add view
   * 
   * admin/modules/forms/add
   * 
   * Responds to requests to GET
   */
  public function getAdd() {

    $aData = array();

    if (\Session::get('info') != NULL) {
      $aData['msgInfo'] = \Session::get('info');
    }

    if (\Session::get('success') != NULL) {
      $aData['msgSuccess'] = \Session::get('success');
    }

    if (\Session::get('error') != NULL) {
      $aData['msgError'] = \Session::get('error');
    }

    $aCaptchas = CaptchaHelper::getAll($this->getModuleConfig());

    $aData['fieldTypes'] = FormBuilder::getFieldTypes();
    $aData['validationRules'] = array_prepend(FormBuilder::getValidationRules(), '--', NULL);
    $aData['itemsFields'] = $this->getItemsFields();
    $aData['aCaptcha'] = $this->getCaptchasForSelect($aCaptchas);

    return view('forms-admin::admin/add', $aData);
  }

  /**
   * Save new form
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

      $data = $request->all();
      $data['captcha_namespace'] = $aCaptchas[$request->get('select_captcha')]['namespace'];
      //$data['items'] = FormBuilder::getPostItems();

      $id = $modelDB->add($data);

      \Session::flash('success', 'Form ' . $data['name'] . ' was created');

      if ($request->get('_update')) {
        return redirect('admin/modules/forms/edit/' . $id);
      } else {
        return redirect('admin/modules/forms');
      }
    } else {
      //dd('validations');
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
    $aParams['fieldTypes'] = FormBuilder::getFieldTypes();
    $aParams['validationRules'] = array_prepend(FormBuilder::getValidationRules(), '--', NULL);
    $aParams['itemsFields'] = $this->getItemsFields(FormsItemsRepository::getItems($id));

    return view('forms-admin::admin/edit', $aParams);
  }

  /**
   * Edit
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

      //$aData['items'] = FormBuilder::getPostItems();
      //dd($aData);
      $oModel->edit($id, $aData);
      
      \Session::flash('success', 'Form ' . $request->get('name') . ' was edited');
      
      if ($request->get('_update')) {
        return redirect('admin/modules/forms/edit/' . $id);
      } else {
        return redirect('admin/modules/forms');
      }

    } else {
      return redirect('admin/modules/forms/edit/' . $id)->withErrors($validator)->withInput();
    }
  }

  /**
   * Delete
   * 
   * admin/modules/forms/delete/{id}
   * 
   * Responds to requests to GET
   */
  public function getDelete($id = NULL) {

    if (FormsRepository::deleteEntry($id)) {
      return redirect('admin/modules/forms')->with('success', 'Form was deleted');
    } else {
      return redirect('admin/modules/forms')->with('error', 'Invalid ID');
    }
  }

  public function getExportCsv($id = NULL) {

    $model = \Module\Forms\Models\Repositories\FormsResultsRepository::getResults($id);

    \Module\Forms\Helpers\Export::toCSV($model, $id);
  }
  
  public function postUpdateConfig(Request $request) {
    $model = new FormsConfigRepository();
    $model->updateConfig($request->all());
    
    return redirect()->back()->with('success', 'Config was updated');
  }

  private function getCaptchasForSelect($aCaptchas) {

    $aSelect = array();

    foreach ($aCaptchas as $k => $captcha) {
      $aSelect[$k] = $captcha['name'];
    }

    return $aSelect;
  }

  private function getItemsFields($oItems = NULL) {

    $items = self::getItemsNames();

    if (!empty(old())) {
      $aItems = array();
      foreach ($items as $item) {
        if (is_array(old($item))) {
          foreach (old($item) as $k => $val) {
            $aItems[$k][$item]['name'] = $item . '[' . $k . ']';
            $aItems[$k][$item]['value'] = $val;
          }
        }
      }
    } else {
      $aItems = array();
      if ($oItems != NULL && $oItems->count() != 0) {
        foreach ($oItems as $item) {
          foreach ($items as $it) {
            $aItems[$item->id][$it]['name'] = $it . '[' . $item->id . ']';
            if ($it == 'attributes') {
              $aAttrs = unserialize($item->$it);
              $attrs = '';
              if (is_array($aAttrs)) {
                foreach ($aAttrs as $attr_k => $attr_v) {
                  $attrs .= $attr_k . '=>' . $attr_v . "\n";
                }
              }
              $aItems[$item->id][$it]['value'] = trim($attrs);
            } else if ($it == 'field_value') {              
              $field_value = unserialize($item->$it);
              $field_val = '';
              if (is_array($field_value)) {
                foreach ($field_value as $fv_k => $fv_v) {
                  $field_val .= $fv_k . '=>' . $fv_v . "\n";
                }
              } else {
                $field_val = $field_value;
              }
              $aItems[$item->id][$it]['value'] = trim($field_val);
            } else {
              $aItems[$item->id][$it]['value'] = $item->$it;
            }
          }
        }
      } else {
        $aItems = $this->getDefaultValues($items);
      }
    }
    return $aItems;
  }

  private function getDefaultValues($items) {

    $aI = array();
    foreach ($items as $k => $item) {
      $aI[$item]['name'] = $item . '[]';
      if ($item == 'weight') {
        $aI[$item]['value'] = 1;
      } else {
        $aI[$item]['value'] = NULL;
      }
    }
    $aItems[] = $aI;
    
    return $aItems;
  }
  
  public static function getItemsNames() {
    return ['field_name', 'field_type', 'label', 'validation', 'attributes', 'field_value', 'weight', 'validation_msg'];
  }

}
