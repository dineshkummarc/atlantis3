<?php

namespace Module\Blog\Controllers\Admin;

use App\Http\Controllers\Controller;
use Module\Blog\Models\Repositories\BlogRepository as Blog;
use Illuminate\Support\Facades\Config;

class BlogAdminController extends Controller {

  public function __construct() {
    
    $this->config = Config::get('blog.setup');
    
    $this->middleware('Atlantis\Middleware\AdminAuth');
    $this->middleware('Atlantis\Middleware\Permissions:'. $this->config['moduleNamespace'] .','
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
    
    $oBlog = Blog::getAll();
    
    //return var_dump($oBlog);
    
    return view('blog::admin/list');
  }

  /*
   * Show add blog view
   * 
   * modules/blog/add
   * 
   * Responds to requests to GET
   */

  public function getAdd() {    
    
    return view('blog::admin/add');
  }

  /*
   * Save new blog entry
   * 
   * modules/blog/add
   * 
   * Responds to requests to POST 
   */

  public function postAdd() {
    
    return redirect('modules/blog');
    
  }

  /*
   * Show edit blog view
   * 
   * modules/blog/edit/{id}
   * 
   * Responds to requests to GET
   */

  public function getEdit($id = null) {
    
    return view('blog::admin/edit');
    
  }

  /*
   * Edit blog entry
   * 
   * modules/blog/edit/{id}
   * 
   * Responds to requests to POST
   */

  public function postEdit($id = null) {
    
    return redirect('modules/blog');
    
  }

  /*
   * Delete blog entry
   * 
   * modules/blog/delete/{id}
   * 
   * Responds to requests to POST
   */

  public function postDelete($id = null) {
    
    return redirect('modules/blog');
    
  }

}
