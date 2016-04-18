<?php

namespace Module\OpenGraph\Events;

/*
 * Event: OpenGraph
 * @Atlantis CMS
 * v 1.0
 */

use Illuminate\Queue\SerializesModels;
use Atlantis\Helpers\Assets;

class OpenGraphEvent extends \Illuminate\Support\Facades\Event {

  use SerializesModels;

  public function setTags($oPage) {

    $oMedia = \Atlantis\Models\Repositories\MediaRepository::getImage($oPage->preview_thumb_id);

    $this->openGraph($oPage, $oMedia);

    $this->twitterTags($oPage, $oMedia);
  }

  public function subscribe($events) {

    $events->listen('page.loaded', 'Module\OpenGraph\Events\OpenGraphEvent@setTags');
  }

  private function openGraph($oPage, $oMedia) {

    if ($oMedia != NULL) {
      $image = url(config('user_media_upload') . $oMedia->original_filename);
    }

    /**
     * Pinterest need to use <meta property="og:type" content="article" />
     */
    Assets::registerHeadTag('<meta property="og:type" content="website" />');
    //$a->registerHeadTag('<meta property="og:type" content="article" />');
    
    Assets::registerHeadTag('<meta property="og:title" content="' . htmlentities($oPage->seo_title) . '" />');
    Assets::registerHeadTag('<meta property="og:description" content="' . htmlentities($oPage->meta_description) . '" />');    
    Assets::registerHeadTag('<meta property="og:url" content="' . request()->url() . '" />');
    Assets::registerHeadTag('<meta property="og:site_name" content="' . htmlentities(config('site_name')) . '" />');
    if (isset($image)) {
      Assets::registerHeadTag('<meta property="og:image" content="' . $image . '" />');
    }
  }

  private function twitterTags($oPage, $oMedia) {
    
     if ($oMedia != NULL) {
      $image = url(config('user_media_upload') . $oMedia->original_filename);
    }
    
    Assets::registerHeadTag('<meta name="twitter:card" content="summary_large_image">');
    Assets::registerHeadTag('<meta name="twitter:site" content="@' . str_replace(' ', '', htmlentities(config('site_name'))) . '">');
    Assets::registerHeadTag('<meta name="twitter:creator" content="@' . str_replace(' ', '', htmlentities($oPage->author)) . '">');
    Assets::registerHeadTag('<meta name="twitter:title" content="' . htmlentities($oPage->seo_title) . '" />');
    Assets::registerHeadTag('<meta name="twitter:description" content="' . htmlentities($oPage->meta_description) . '" />');
    if (isset($image)) {
      Assets::registerHeadTag('<meta name="twitter:image" content="' . $image . '" />');
    }
  }

}
