<?php

namespace Module\Blog\Controllers;

use App\Http\Controllers\Controller;
use Module\Blog\Models\Repositories\BlogRepository;
use Illuminate\Support\Facades\DB;
use Module\Blog\Models\Repositories\BlogConfigRepository;

class BlogController extends Controller {

  use \Module\Blog\Traits\BlogTrait;

  public static $title;
  public static $description;

  /**
   * <div data-pattern-func="module:blog@single"></div>
   */
  public function single() {

    $base_route = \Route::input('page');

    $entry = DB::table('blog')->where(DB::raw('CONCAT("' . BlogConfigRepository::getConfigKey('anchor_url') . '/", url)'), "/" . $base_route)->first();

    if (count($entry)) {

      $data = array();

      $data['data'] = $entry;

      self::$title = $entry->seo_title;
      self::$description = $entry->meta_description;

      $images = \MediaTools::getImagesByGallery($entry->gallery_id);
      $data['images'] = $images;

      $ogData = [
          'type' => 'article',
          'title' => $entry->title,
          'description' => $entry->description,
          'url' => url(BlogConfigRepository::getConfigKey('anchor_url') . '/' . $entry->url),
          'author' => $entry->nickname
      ];

      if (isset($images[0])) {
        $ogData['image'] = url($images[0]->original_filename);
      }

      \Atlantis\Helpers\Assets::registerContentWithKey('opengraph', $ogData);

      return view('blog::blog-single', $data);
    } else {
      return redirect('404');
    }
  }

  /**
   * <div data-pattern-func="module:blog@all"></div>
   */
  public function all() {

    $oBlogs = BlogRepository::getAll();

    $featuredImages = \MediaTools::getFeaturedImages($oBlogs);

    $aParams = array();

    $aParams['oBlogs'] = $oBlogs;
    $aParams['featuredImages'] = $featuredImages;
    $aParams['anchor_url'] = BlogConfigRepository::getConfigKey('anchor_url');

    return view('blog::blog-list', $aParams);
  }

}
