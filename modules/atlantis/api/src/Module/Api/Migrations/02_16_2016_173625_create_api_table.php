<?php

/*
 * Migration: Api
 * @Atlantis CMS
 * v 1.0
 */

use Illuminate\Database\Migrations\Migration;

class CreateApiTable extends Migration {

        /**
        * Run the migrations.
        */
        public function up()
        {
                /*
                Schema::create('api', function(\Illuminate\Database\Schema\Blueprint $table)
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
