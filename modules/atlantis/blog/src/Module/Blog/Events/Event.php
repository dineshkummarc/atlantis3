<?php

namespace Module\Blog\Events;

use Illuminate\Queue\SerializesModels;

class Event extends \Illuminate\Support\Facades\Event{

  
  use SerializesModels;
  
  
    public function subscribe($events) {
    
    $events->listen('page.title', 'Module\Blog\Events\Event@pageTitle');
    
  }
  
  
  public function pageTitle() {
    
     $t = \App::make('Transport');
     
     $t->setEventValue("page.title", array("title" => \Module\Blog\Controllers\BlogController::getTitle() , "weight" => 10) );
      
  }

  
}