<?php

namespace Module\Blog\Models\Repositories;

use Module\Blog\Models\Blog as Blog;

class BlogRepository {
  
  public static function getAll() {
    //return 'test';
    return Blog::all();
    
  }
  
}

