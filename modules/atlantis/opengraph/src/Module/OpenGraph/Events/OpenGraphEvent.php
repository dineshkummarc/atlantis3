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

    //dd($oPage->title);
    
    $a = \App::make('Assets');
    
    $a->registerHeadTag('<meta property="og:title" content="' . $oPage->seo_title . '" />');    
    
  }

  public function subscribe($events) {
    
    $events->listen('page.loaded', 'Module\OpenGraph\Events\OpenGraphEvent@setTags');
  }

}
