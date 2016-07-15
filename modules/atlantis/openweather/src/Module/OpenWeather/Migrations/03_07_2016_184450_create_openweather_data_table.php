<?php

/*
 * Migration: OpenWeather
 * @Atlantis CMS
 * v 1.0
 */

use Illuminate\Database\Migrations\Migration;

class CreateOpenweatherDataTable extends Migration {

  /**
   * Run the migrations.
   */
  public function up() {

    if (!Schema::hasTable('openweather_data')) {
      Schema::create('openweather_data', function(\Illuminate\Database\Schema\Blueprint $table) {
        $table->increments('id');
        $table->text('data');
        $table->string('type', 255);
        $table->timestamps();
      });
    }
  }

  /**
   * Reverse the migrations.
   */
  public function down() {

    if (Schema::hasTable('openweather_data')) {
      Schema::drop('openweather_data');
    }
  }

}
