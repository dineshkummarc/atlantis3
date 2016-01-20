<?php


use Illuminate\Database\Migrations\Migration;

class CreateBlankTable extends Migration {

        /**
        * Run the migrations.
        */
        public function up()
        {
                //
                Schema::create('googleanalytics', function(\Illuminate\Database\Schema\Blueprint $table)
                {
                        $table->increments('id');
                        $table->string("tracking_code");
                        $table->string("tag_manager_code");
                        $table->string("active");
                        $table->timestamps();
                });
        }

        /**
        * Reverse the migrations.
        */
        public function down()
        {
                //
        }

}