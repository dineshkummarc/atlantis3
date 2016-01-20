<?php

namespace Module\Vanityurl\Events;

use Illuminate\Queue\SerializesModels;


class VanityEvent  extends \Illuminate\Support\Facades\Event{

  
  use SerializesModels;
  
  
  public function subscribe($events) {
    
    $events->listen('page.prediscovery', 'Module\\Vanityurl\Controllers\VanityurlController@redirect');
    
  }
  
}
