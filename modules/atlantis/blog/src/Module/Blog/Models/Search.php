<?php

namespace Module\Blog\Models; 

 class Search extends \Atlantis\Models\Base {

   public static function get($search) {
     
     //DO all operations here , need to return an array with  url / name keypair
     
     return [
         config('blog.config.anchor_url') . '/demo-page1' => 'blog demo1',
         config('blog.config.anchor_url') . '/demo-page2' => 'blog demo2',
         config('blog.config.anchor_url') . '/demo-page3' => 'blog demo3',
         config('blog.config.anchor_url') . '/demo-page4' => 'blog demo4',
         config('blog.config.anchor_url') . '/demo-page5' => 'blog demo5'         
         ];    
   }   
   
 }
