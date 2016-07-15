<?php

/*
 * Migration: OpenWeather
 * @Atlantis CMS
 * v 1.0
 */

use Illuminate\Database\Migrations\Migration;

class CreateOpenweatherTable extends Migration {

  /**
   * Run the migrations.
   */
  public function up() {

    if (!Schema::hasTable('openweather')) {
      Schema::create('openweather', function(\Illuminate\Database\Schema\Blueprint $table) {
        $table->increments('id');
        $table->string("app_id");
        $table->string("temperature")->default('C');
        $table->timestamps();
      });
    }
  }

  /**
   * Reverse the migrations.
   */
  public function down() {

    if (Schema::hasTable('openweather')) {
      Schema::drop('openweather');
    }
  }

}
