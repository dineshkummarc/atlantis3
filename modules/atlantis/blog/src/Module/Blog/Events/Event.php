<?php

namespace Module\Blog\Events;

use Illuminate\Queue\SerializesModels;

class Event extends \Illuminate\Support\Facades\Event{

  
  use SerializesModels;
  
  
    public function subscribe($events) {
      
    $events->listen('page.title', 'Module\Blog\Events\Event@pageTitle');
    $events->listen('page.meta_description', 'Module\Blog\Events\Event@pageDescription');
    
  }
  
  
  public function pageTitle() {
    
     $t = \App::make('Transport');
     
     $t->setEventValue("page.title", array("title" => \Module\Blog\Controllers\BlogController::$title , "weight" => 10) );
      
  }

  
  public function pageDescription() {
    
     $t = \App::make('Transport');
     
     $t->setEventValue("page.meta_description", array("title" => \Module\Blog\Controllers\BlogController::$description , "weight" => 10) );
      
  }
  
}