<?php

namespace Module\Colorbox\Controllers\Admin;

use Atlantis\Controllers\Admin\AdminModulesController;
use Illuminate\Http\Request;
use Module\Colorbox\Models\Repositories\ColorboxRepository;

class ColorboxAdminController extends AdminModulesController {

  public function __construct() {
    parent::__construct(\Config::get('colorbox.setup'));
  }

  public function getIndex() {

    $aData = array();

    if (\Session::get('info') != NULL) {
      $aData['msgInfo'] = \Session::get('info');
    }

    if (\Session::get('success') != NULL) {
      $aData['msgSuccess'] = \Session::get('success');
    }

    if (\Session::get('error') != NULL) {
      $aData['msgError'] = \Session::get('error', $aData);
    }

    return view("colorbox-admin::admin/list", $aData);
  }

  public function getAdd() {

    $aData = array();

    if (\Session::get('info') != NULL) {
      $aData['msgInfo'] = \Session::get('info');
    }

    if (\Session::get('success') != NULL) {
      $aData['msgSuccess'] = \Session::get('success');
    }

    if (\Session::get('error') != NULL) {
      $aData['msgError'] = \Session::get('error', $aData);
    }
    $aData['aGalleries'] = \Atlantis\Models\Repositories\GalleryRepository::getAllGalleriesForSelect();
    return view("colorbox-admin::admin/add", $aData);
  }

  public function getEdit($id = NULL) {

    $aData = array();

    if (\Session::get('info') != NULL) {
      $aData['msgInfo'] = \Session::get('info');
    }

    if (\Session::get('success') != NULL) {
      $aData['msgSuccess'] = \Session::get('success');
    }

    if (\Session::get('error') != NULL) {
      $aData['msgError'] = \Session::get('error', $aData);
    }

    $model = ColorboxRepository::getItem($id);

    if ($model != NULL) {

      $aData['model'] = $model;
      $aData['aGalleries'] = \Atlantis\Models\Repositories\GalleryRepository::getAllGalleriesForSelect();
    } else {
      $aData['invalid_item'] = 'This item is not valid';
    }
    return view("colorbox-admin::admin/edit", $aData);
  }

  public function postAdd(Request $request) {

    $oModel = new ColorboxRepository();

    $data = $request->all();

    $validator = $oModel->validationCreate($data);

    if (!$validator->fails()) {

      $id = $oModel->addItems($data);

      \Session::flash('success', 'Item ' . $data['name'] . ' was created');

      if ($request->get('_update')) {
        return redirect('admin/modules/colorbox/edit/' . $id);
      } else {
        \Session::flash('tab_panel', 'categories');
        return redirect('admin/modules/colorbox');
      }
    } else {
      return redirect()->back()->withErrors($validator)->withInput();
    }
  }
  
  public function postEdit($id = NULL, Request $request) {

    $oModel = new ColorboxRepository();

    $data = $request->all();

    $validator = $oModel->validationCreate($data, $id);

    if (!$validator->fails()) {

      $oModel->editItem($id, $data);

      \Session::flash('success', 'Item ' . $data['name'] . ' was edited');

      if ($request->get('_update')) {
        return redirect('admin/modules/colorbox/edit/' . $id);
      } else {
        \Session::flash('tab_panel', 'categories');
        return redirect('admin/modules/colorbox');
      }
    } else {
      return redirect()->back()->withErrors($validator)->withInput();
    }
  }

  public function getDelete($id = NULL) {

    if ($id != NULL) {
      ColorboxRepository::deleteItem($id);

      \Session::flash('success', 'Item was deleted');
      return redirect('admin/modules/colorbox');
    }
  }

  public function postBulkAction(Request $request) {

    if ($request->get('bulk_action_ids') != NULL) {

      $aIDs = explode(',', $request->get('bulk_action_ids'));

      if ($request->get('action') == 'bulk_delete') {

        foreach ($aIDs as $id) {
          ColorboxRepository::deleteItem($id);
          ;
        }
        \Session::flash('success', 'Items was deleted');
      }
    }
    return redirect()->back();
  }

}
