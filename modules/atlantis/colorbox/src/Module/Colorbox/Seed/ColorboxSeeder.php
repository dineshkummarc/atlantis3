<?php

 namespace Module\Colorbox\Seed;

/*
 * Seed: Colorbox
 * @Atlantis CMS
 * v 1.0
 */

class ColorboxSeeder extends \Illuminate\Database\Seeder
{

  public function run()
  {

     $setup = require(base_path(). '/modules/atlantis/colorbox/src/Module/Colorbox/Setup/Setup.php');

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
