<?php

use Illuminate\Database\Migrations\Migration;

class CreateApiTables extends Migration {

        /**
        * Run the migrations.
        */
        public function up()
        {
                //
                Schema::create('api_users', function(\Illuminate\Database\Schema\Blueprint $table)
                {
                        $table->increments('id');
                        $table->string("username");
                        $table->string("password");
                        $table->string("active");
                        $table->timestamps();
                });

                Schema::create('api_tokens', function(\Illuminate\Database\Schema\Blueprint $table)
                {
                        $table->increments('id');
                        $table->string("token");
                        $table->string("user_agent");
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