<?php

namespace Module\Blog\Models; 

 class Search extends \Atlantis\Models\Base {

   public static function get($search) {
     
     //DO all operations here , need to return an array with  url / name keypair
     
     return [config('blog.config.anchor_url') . '/demo-page' => 'name'];    
   }   
   
 }
