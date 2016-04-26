<?php

use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration {

  /**
   * Run the migrations.
   */
  public function up() {
    //
    Schema::create('menus', function(\Illuminate\Database\Schema\Blueprint $table) {
      $table->increments('id');
      $table->string("name", 255)->nullable();
      $table->string("css", 255)->nullable();
      $table->string("element_id", 255)->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down() {
    Schema::drop('menus');
  }

}
