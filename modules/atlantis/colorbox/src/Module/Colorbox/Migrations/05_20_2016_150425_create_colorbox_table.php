<?php

/*
 * Migration: Colorbox
 * @Atlantis CMS
 * v 1.0
 */

use Illuminate\Database\Migrations\Migration;

class CreateColorboxTable extends Migration {

        /**
        * Run the migrations.
        */
        public function up()
        {
                
                Schema::create('colorbox', function(\Illuminate\Database\Schema\Blueprint $table)
                {
                        $table->increments('id');
                        $table->string('name', 255)->nullabel();
                        $table->integer('gallery_id');
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
