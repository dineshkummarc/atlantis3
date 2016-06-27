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

  private $aCustomData = array();

  public function subscribe($events) {

    $events->listen('page.loaded', 'Module\OpenGraph\Events\OpenGraphEvent@setTags', -1);
  }

  public function setTags($oPage) {   

    $data = Assets::getContentWithKey('opengraph');

    if (is_array($data)) {
      $this->aCustomData = last($data);
    }

    $oMedia = \Atlantis\Models\Repositories\MediaRepository::getImage($oPage->preview_thumb_id);

    $this->openGraph($oPage, $oMedia);

    $this->twitterTags($oPage, $oMedia);
  }

  private function openGraph($oPage, $oMedia) {

    if ($oMedia != NULL) {
      $image = url(\Atlantis\Helpers\Tools::getFilePath() . $oMedia->original_filename);
    }

    /**
     * Pinterest need to use <meta property="og:type" content="article" />
     */
    if (isset($this->aCustomData['type'])) {
      Assets::registerHeadTag('<meta property="og:type" content="' . $this->aCustomData['type'] . '" />');
    } else {
      Assets::registerHeadTag('<meta property="og:type" content="website" />');
      //$a->registerHeadTag('<meta property="og:type" content="article" />');
    }

    if (isset($this->aCustomData['title'])) {
      Assets::registerHeadTag('<meta property="og:title" content="' . htmlentities($this->aCustomData['title']) . '" />');
    } else {
      Assets::registerHeadTag('<meta property="og:title" content="' . htmlentities($oPage->seo_title) . '" />');
    }

    if (isset($this->aCustomData['description'])) {
      Assets::registerHeadTag('<meta property="og:description" content="' . htmlentities($this->aCustomData['description']) . '" />');
    } else {
      Assets::registerHeadTag('<meta property="og:description" content="' . htmlentities($oPage->meta_description) . '" />');
    }

    if (isset($this->aCustomData['url'])) {
      Assets::registerHeadTag('<meta property="og:url" content="' . $this->aCustomData['url'] . '" />');
    } else {
      Assets::registerHeadTag('<meta property="og:url" content="' . request()->url() . '" />');
    }

    if (isset($this->aCustomData['site_name'])) {
      Assets::registerHeadTag('<meta property="og:site_name" content="' . htmlentities($this->aCustomData['site_name']) . '" />');
    } else {
      Assets::registerHeadTag('<meta property="og:site_name" content="' . htmlentities(config('site_name')) . '" />');
    }

    if (isset($this->aCustomData['image'])) {
      Assets::registerHeadTag('<meta property="og:image" content="' . $this->aCustomData['image'] . '" />');
    } else {
      if (isset($image)) {
        Assets::registerHeadTag('<meta property="og:image" content="' . $image . '" />');
      }
    }
  }

  private function twitterTags($oPage, $oMedia) {

    if ($oMedia != NULL) {
      $image = url(\Atlantis\Helpers\Tools::getFilePath() . $oMedia->original_filename);
    }

    Assets::registerHeadTag('<meta name="twitter:card" content="summary_large_image">');

    if (isset($this->aCustomData['site_name'])) {
      Assets::registerHeadTag('<meta name="twitter:site" content="@' . str_replace(' ', '', htmlentities($this->aCustomData['site_name'])) . '">');
    } else {
      Assets::registerHeadTag('<meta name="twitter:site" content="@' . str_replace(' ', '', htmlentities(config('site_name'))) . '">');
    }

    if (isset($this->aCustomData['author'])) {
      Assets::registerHeadTag('<meta name="twitter:creator" content="@' . str_replace(' ', '', htmlentities($this->aCustomData['author'])) . '">');
    } else {
      Assets::registerHeadTag('<meta name="twitter:creator" content="@' . str_replace(' ', '', htmlentities($oPage->author)) . '">');
    }

    if (isset($this->aCustomData['title'])) {
      Assets::registerHeadTag('<meta name="twitter:title" content="' . htmlentities($this->aCustomData['title']) . '" />');
    } else {
      Assets::registerHeadTag('<meta name="twitter:title" content="' . htmlentities($oPage->seo_title) . '" />');
    }

    if (isset($this->aCustomData['description'])) {
      Assets::registerHeadTag('<meta name="twitter:description" content="' . htmlentities($this->aCustomData['description']) . '" />');
    } else {
      Assets::registerHeadTag('<meta name="twitter:description" content="' . htmlentities($oPage->meta_description) . '" />');
    }

    if (isset($this->aCustomData['image'])) {
      Assets::registerHeadTag('<meta name="twitter:image" content="' . $this->aCustomData['image'] . '" />');
    } else {
      if (isset($image)) {
        Assets::registerHeadTag('<meta name="twitter:image" content="' . $image . '" />');
      }
    }
  }

}
