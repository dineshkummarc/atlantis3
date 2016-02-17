<?php

namespace Module\Blog\Controllers\Admin;

use App\Http\Controllers\Controller;
use Module\Blog\Models\Repositories\BlogRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

class BlogAdminController extends Controller {

  public $status = [
      'published' => 'publish',
      'draft' => 'draft'
  ];
  public $allow_comments = [
      1 => 'allow',
      0 => 'disallow'
  ];

  public function __construct() {

    $this->config = Config::get('blog.setup');

    $this->middleware('Atlantis\Middleware\AdminAuth');
    $this->middleware('Atlantis\Middleware\Permissions:' . $this->config['moduleNamespace'] . ','
            . 'Atlantis\Models\Repositories\RoleUsersRepository,'
            . 'Atlantis\Models\Repositories\PermissionsRepository');
  }

  /*
   * Show list
   * 
   * modules/blog
   * 
   * Responds to requests to GET
   */

  public function getIndex($id = null) {

    $oBlogs = BlogRepository::getAll();

    $aParams = array();

    $aParams['oBlogs'] = $oBlogs;

    return view('blog::admin/list', $aParams);
  }

  /*
   * Show add blog view
   * 
   * modules/blog/add
   * 
   * Responds to requests to GET
   */

  public function getAdd() {

    $aParams = array();

    $aParams['status_dropdown'] = $this->status;
    $aParams['allow_comments_dropdown'] = $this->allow_comments;
    $aParams['nickname'] = auth()->user()->name;

    return view('blog::admin/add', $aParams);
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

      $blogDB->add($aData);

      return redirect('admin/modules/blog')->with('success', 'Success');
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

    $aParams = array();

    $aParams['status_dropdown'] = $this->status;
    $aParams['allow_comments_dropdown'] = $this->allow_comments;
    $aParams['oBlog'] = $oBlog;

    return view('blog::admin/edit', $aParams);
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

    $validator = $blogDB->validationEdit($request->all());

    if (!$validator->fails()) {

      $blogDB->edit($id, $request->all());

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
      return redirect('admin/modules/blog')->with('success', 'Success');
    } else {
      return redirect('admin/modules/blog')->with('error', 'Invalid ID');
    }
  }

}
