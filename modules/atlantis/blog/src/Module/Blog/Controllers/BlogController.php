<?php

namespace Module\Blog\Controllers;

use App\Http\Controllers\Controller;
use Module\Blog\Models\Repositories\BlogRepository;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller {

  public static $title;
  private $config;

  public function __construct() {

    $this->config = config('blog.config');
  }

  /**
   * <div data-pattern-func="module:blog@single"></div>
   */
  public function single() {

    $base_route = \Route::input('page');

    $entry = DB::table('blog')->where(DB::raw('CONCAT("' . $this->config['anchor_url'] . '/", url)'), "/" . $base_route)->first();

    if (count($entry)) {

      self::$title = $entry->title;

      return view('blog::blog-single', ['data' => $entry]);
    } else {
      return redirect('404');
    }
  }

  /**
   * <div data-pattern-func="module:blog@all"></div>
   */
  public function all() {

    $oBlogs = BlogRepository::getAll();

    $featureImages = \MediaTools::getFeaturedImages($oBlogs);

    $aParams = array();

    $aParams['oBlogs'] = $oBlogs;
    $aParams['featureImages'] = $featureImages;
    $aParams['anchor_url'] = $this->config['anchor_url'];

    return view('blog::blog-list', $aParams);
  }

}
