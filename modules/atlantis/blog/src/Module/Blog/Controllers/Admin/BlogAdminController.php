<?php

namespace Module\Blog\Controllers\Admin;

use Module\Blog\Models\Repositories\BlogRepository;
use Illuminate\Http\Request;
use Atlantis\Controllers\Admin\AdminModulesController;

class BlogAdminController extends AdminModulesController {

  public $status = [
      'published' => 'publish',
      'draft' => 'draft'
  ];
  public $allow_comments = [
      1 => 'allow',
      0 => 'disallow'
  ];

  public function __construct() {
    parent::__construct(\Config::get('blog.setup'));
  } 

  /*
   * Show list
   * 
   * modules/blog
   * 
   * Responds to requests to GET
   */

  public function getIndex($id = null) {
    
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

    return view('blog-admin::admin/list', $aData);
  }

  /*
   * Show add blog view
   * 
   * modules/blog/add
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

    $aData['status_dropdown'] = $this->status;
    $aData['allow_comments_dropdown'] = $this->allow_comments;
    $aData['nickname'] = auth()->user()->name;

    return view('blog-admin::admin/add', $aData);
  }

  /*
   * Save new blog entry
   * 
   * modules/blog/add
   * 
   * Responds to requests to POST 
   */

  public function postAdd(Request $request) {

    $blogDB = new BlogRepository();

    $validator = $blogDB->validationCreate($request->all());
   
    if (!$validator->fails()) {

      $aData = $request->all();
      $aData['user_id'] = auth()->user()->id;

      $id = $blogDB->add($aData);

      \Session::flash('success', 'Entry ' . $aData['title'] . ' was created');
      
      if ($request->get('_update')) {
        return redirect('admin/modules/blog/edit/' . $id);
      } else {
        return redirect('admin/modules/blog');
      }
      
    } else {
      return redirect('admin/modules/blog/add')->withErrors($validator)->withInput();
    }
  }

  /*
   * Show edit blog view
   * 
   * modules/blog/edit/{id}
   * 
   * Responds to requests to GET
   */

  public function getEdit($id = null) {

    $oBlog = BlogRepository::get($id);

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

    $aTags = array();
    
    $tags = \Atlantis\Models\Repositories\TagRepository::getTagsByResourceID('blog', $id);
    
    foreach ($tags as $tag) {
      $aTags[] = $tag->tag;
    }
    
    $aData['posted_date'] = \Atlantis\Helpers\Tools::getExpirationDateForView($oBlog->posted_date);
    $aData['tags'] = implode(',', $aTags);
    $aData['status_dropdown'] = $this->status;
    $aData['allow_comments_dropdown'] = $this->allow_comments;
    $aData['oBlog'] = $oBlog;

    return view('blog-admin::admin/edit', $aData);
  }

  /*
   * Edit blog entry
   * 
   * modules/blog/edit/{id}
   * 
   * Responds to requests to POST
   */

  public function postEdit($id = null, Request $request) {

    $blogDB = new BlogRepository();

    $validator = $blogDB->validationCreate($request->all(), $id);

    if (!$validator->fails()) {

      $blogDB->edit($id, $request->all());

      \Session::flash('success', 'Entry ' . $request->get('title') . ' was edited');
      
      if ($request->get('_update')) {
        return redirect('admin/modules/blog/edit/' . $id);
      } else {
        return redirect('admin/modules/blog');
      }
      
      return redirect('admin/modules/blog')->with('success', 'Success');
    } else {
      return redirect('admin/modules/blog/edit/' . $id)->withErrors($validator)->withInput();
    }
  }

  /*
   * Delete blog entry
   * 
   * modules/blog/delete/{id}
   * 
   * Responds to requests to GET
   */

  public function getDelete($id = null) {

    if (BlogRepository::deleteEntry($id)) {
      return redirect('admin/modules/blog')->with('success', 'Entry was deleted');
    } else {
      return redirect('admin/modules/blog')->with('error', 'Invalid ID');
    }
  }
  
  public function postBulkAction(Request $request) {

    if ($request->get('bulk_action_ids') != NULL) {

      $aIDs = explode(',', $request->get('bulk_action_ids'));

      if ($request->get('action') == 'bulk_delete') {

        foreach ($aIDs as $id) {
          BlogRepository::deleteEntry($id);
        }
        \Session::flash('success', 'Entries was deleted');
      }
    }

    return redirect()->back();
  }

}
