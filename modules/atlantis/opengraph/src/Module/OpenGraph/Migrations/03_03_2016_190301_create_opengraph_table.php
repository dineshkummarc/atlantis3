<?php

/*
 * Migration: OpenGraph
 * @Atlantis CMS
 * v 1.0
 */

use Illuminate\Database\Migrations\Migration;

class CreateOpenGraphTable extends Migration {

        /**
        * Run the migrations.
        */
        public function up()
        {
                /*
                Schema::create('opengraph', function(\Illuminate\Database\Schema\Blueprint $table)
                {
                        $table->increments('id');
                        $table->string("title");
                        $table->timestamps();
                });
                * 
                */
        }

        /**
        * Reverse the migrations.
        */
        public function down()
        {
                //
        }

}
