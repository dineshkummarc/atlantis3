<?php

namespace Module\Blog\Models;

class Sitemap extends \Atlantis\Models\Base {

  public static function get() {

    /**
     * DO all operations here , need to return an array with urls and updated dates for all public views
     * 
     *  return [
                 [
                  'url' => 'test/url',
                  'updated_at' => '2016-08-16 15:20:30'
                 ],
                 [
                  'url' => 'test/url1',
                  'updated_at' => '2016-08-16 15:20:58'
                 ]
                ];
     */
    
    $allBlogs = Repositories\BlogRepository::getAllPublished();

    $anchorUrl = Repositories\BlogConfigRepository::getConfigKey('anchor_url');

    if (substr($anchorUrl, -1) != '/') {
      $anchorUrl = $anchorUrl . '/';
    }

    $aRes = array();

    foreach ($allBlogs as $k => $entry) {

      $entry->url = ltrim($entry->url, '/');

      $aRes[$k]['url'] = $anchorUrl . $entry->url;
      $aRes[$k]['updated_at'] = $entry->updated_at;
    }

    return $aRes;
  }

}
