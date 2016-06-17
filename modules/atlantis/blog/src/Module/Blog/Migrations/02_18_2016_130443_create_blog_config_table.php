<?php

/*
 * Migration: Forms
 * @Atlantis CMS
 * v 1.0
 */

use Illuminate\Database\Migrations\Migration;

class CreateBlogConfigTable extends Migration {

  /**
   * Run the migrations.
   */
  public function up() {

    Schema::create('blog_config', function(\Illuminate\Database\Schema\Blueprint $table) {
      $table->increments('id');
      $table->string("config_key", 255);
      $table->text("config_value")->nullable();
      $table->timestamps();    
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down() {
    Schema::drop('blog_config');
  }

}
