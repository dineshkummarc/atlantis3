<?php


use Illuminate\Database\Migrations\Migration;

class CreateVanityUrlTable extends Migration {

        /**
        * Run the migrations.
        */
        public function up()
        {
                //
                Schema::create('vanityurl', function(\Illuminate\Database\Schema\Blueprint $table)
                {
                        $table->increments('id');
                        $table->string("source_url");
                        $table->string("dest_url");
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