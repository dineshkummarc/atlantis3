<?php

/*
 * Migration: OpenWeather
 * @Atlantis CMS
 * v 1.0
 */

use Illuminate\Database\Migrations\Migration;

class CreateOpenWeatherCitiesTable extends Migration {

  /**
   * Run the migrations.
   */
  public function up() {

    Schema::create('openweather_cities', function(\Illuminate\Database\Schema\Blueprint $table) {
      $table->integer('id')->primary();
      $table->string('name', 255);
      $table->string('country', 255);
      $table->double('lon', 255);
      $table->double('lat', 255);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down() {
    Schema::drop('openweather_cities');
  }

}
