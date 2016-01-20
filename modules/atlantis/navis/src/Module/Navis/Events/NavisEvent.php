<?php

namespace Module\Navis\Events;

use Illuminate\Queue\SerializesModels;


class DemoEvent  extends \Illuminate\Support\Facades\Event{

  
  use SerializesModels;
  
  public function test() {
    
     $t = \App::make('Transport');
     
    // $t->setEventValue("page.prediscovery", array("name" => "test", "weight" => 10) );
      
  }

  public function handle($event) {
    
      
    
  }
  
  
  public function subscribe($events) {
    
    //$events->listen('page.prediscovery', 'Blank\Events\DemoEvent@test');
    
  }
  
}
