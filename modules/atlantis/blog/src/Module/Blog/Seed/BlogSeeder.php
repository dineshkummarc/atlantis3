<?php

namespace Module\Blog\Seed;

class BlogSeeder extends \Illuminate\Database\Seeder {
  
  public function run() {
    
     $setup = require( base_path(). '/modules/atlantis/blog/src/Module/Blog/Setup/Setup.php');
    
     //check for the module with the same name
    $result = \DB::table("modules")
            ->where("name", "=", "Blog")->first();
    
    if (is_null($result)) {
      
      \DB::table("modules")
              ->insert([
                  'name' => $setup['name'],
                  'author' => $setup['author'],
                  'version' => $setup['version'],
                  'namespace' => $setup['moduleNamespace'],
                  'path' => $setup['path'],
                  'provider' => $setup['provider'],
                  'extra' => serialize($setup['extra']),
                  'adminURL' => $setup['adminURL'],
                  'icon' => $setup['icon'],
                  'active' => 1,
                  'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                  'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
              ]);
      
    }
    
 }
}