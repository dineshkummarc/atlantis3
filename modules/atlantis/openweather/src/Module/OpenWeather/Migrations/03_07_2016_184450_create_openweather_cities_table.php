<?php

/*
 * Migration: OpenWeather
 * @Atlantis CMS
 * v 1.0
 */

use Illuminate\Database\Migrations\Migration;

class CreateOpenweatherCitiesTable extends Migration {

  /**
   * Run the migrations.
   */
  public function up() {

    if (!Schema::hasTable('openweather_cities')) {
      Schema::create('openweather_cities', function(\Illuminate\Database\Schema\Blueprint $table) {
        $table->integer('id')->primary();
        $table->string('name', 255);
        $table->string('country', 255);
        $table->double('lon', 255);
        $table->double('lat', 255);
        $table->timestamps();
      });
    }
  }

  /**
   * Reverse the migrations.
   */
  public function down() {

    if (Schema::hasTable('openweather_cities')) {
      Schema::drop('openweather_cities');
    }
  }

}
