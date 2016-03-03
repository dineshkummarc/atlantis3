<?php

 namespace Module\OpenGraph\Seed;

/*
 * Seed: OpenGraph
 * @Atlantis CMS
 * v 1.0
 */

class OpenGraphSeeder extends \Illuminate\Database\Seeder
{

  public function run()
  {

     $setup = require(base_path(). '/modules/atlantis/opengraph/src/Module/OpenGraph/Setup/Setup.php');

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
                  'active' => $setup['active']
              ]);

     }
  }

}
