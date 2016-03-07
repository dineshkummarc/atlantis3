<?php

namespace Module\OpenGraph\Events;

/*
 * Event: OpenGraph
 * @Atlantis CMS
 * v 1.0
 */

use Illuminate\Queue\SerializesModels;

class OpenGraphEvent extends \Illuminate\Support\Facades\Event {

  use SerializesModels;

  public function setTags($oPage) {

    $oMedia = \Atlantis\Models\Repositories\MediaRepository::getImage($oPage->preview_thumb_id);

    $a = \App::make('Assets');

    $this->openGraph($oPage, $oMedia, $a);

    $this->twitterTags($oPage, $oMedia, $a);
  }

  public function subscribe($events) {

    $events->listen('page.loaded', 'Module\OpenGraph\Events\OpenGraphEvent@setTags');
  }

  private function openGraph($oPage, $oMedia, $a) {

    if ($oMedia != NULL) {
      $image = url(config('user_media_upload') . $oMedia->original_filename);
    }

    /**
     * Pinterest need to use <meta property="og:type" content="article" />
     */
    $a->registerHeadTag('<meta property="og:type" content="website" />');
    //$a->registerHeadTag('<meta property="og:type" content="article" />');
    
    $a->registerHeadTag('<meta property="og:title" content="' . htmlentities($oPage->seo_title) . '" />');
    $a->registerHeadTag('<meta property="og:description" content="' . htmlentities($oPage->meta_description) . '" />');    
    $a->registerHeadTag('<meta property="og:url" content="' . request()->url() . '" />');
    $a->registerHeadTag('<meta property="og:site_name" content="' . htmlentities(config('site_name')) . '" />');
    if (isset($image)) {
      $a->registerHeadTag('<meta property="og:image" content="' . $image . '" />');
    }
  }

  private function twitterTags($oPage, $oMedia, $a) {
    
     if ($oMedia != NULL) {
      $image = url(config('user_media_upload') . $oMedia->original_filename);
    }
    
    $a->registerHeadTag('<meta name="twitter:card" content="summary_large_image">');
    $a->registerHeadTag('<meta name="twitter:site" content="@' . str_replace(' ', '', htmlentities(config('site_name'))) . '">');
    $a->registerHeadTag('<meta name="twitter:creator" content="@' . str_replace(' ', '', htmlentities($oPage->author)) . '">');
    $a->registerHeadTag('<meta name="twitter:title" content="' . htmlentities($oPage->seo_title) . '" />');
    $a->registerHeadTag('<meta name="twitter:description" content="' . htmlentities($oPage->meta_description) . '" />');
    if (isset($image)) {
      $a->registerHeadTag('<meta name="twitter:image" content="' . $image . '" />');
    }
  }

}
