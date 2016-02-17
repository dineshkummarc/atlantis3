<?php

namespace Module\GoogleAnalytics\Seed;

class GoogleAnalyticsSeeder extends \Illuminate\Database\Seeder {
  
  public function run() {
    
     $setup = require( base_path(). '/modules/atlantis/googleanalytics/src/Module/GoogleAnalytics/Setup/Setup.php');
    
     //check for the module with the same name
    $result = \DB::table("modules")
            ->where("name", "=", $setup['name'])->first();
    
    if (is_null($result)) {
      
      \DB::table("modules")
              ->insert([
                  'name' => $setup['name'],
                  'author' => $setup['author'],
                  'version' => $setup['version'], 
                  'namespace' => $setup['moduleNamespace'],
                  'path' => $setup['path'],
                  'provider' => $setup['provider'],
                  'extra' => $setup['extra'],
                  'active' => $setup['active']
              ]);      
    }
    
    $data = $this->getData();

    foreach ($data as $row) {
      DB::table('googleanalytics')->insert($row);
    }
 }
 
 private function getData() {

    return [
        [
            'tracking_code' => 'GA-123',
            'tag_manager_code' => 'GTM-123',
            'active' => 'GTM'
        ] 
    ];
  }
 
}