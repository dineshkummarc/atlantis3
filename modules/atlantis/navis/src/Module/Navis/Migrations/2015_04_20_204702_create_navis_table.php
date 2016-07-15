<?php

use Illuminate\Database\Migrations\Migration;

class CreateNavisTable extends Migration {

  /**
   * Run the migrations.
   */
  public function up() {
    
    if (!Schema::hasTable('navis')) {
      Schema::create('navis', function(\Illuminate\Database\Schema\Blueprint $table) {
        $table->increments('id');
        $table->string("account");
        $table->text("password");

        $table->timestamps();
      });
    }
  }

  /**
   * Reverse the migrations.
   */
  public function down() {
    
    if (Schema::hasTable('navis')) {
      Schema::drop('navis');
    }
  }

}
