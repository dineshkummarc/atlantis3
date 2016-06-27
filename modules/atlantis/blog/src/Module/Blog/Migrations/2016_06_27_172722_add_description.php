<?php

use Illuminate\Database\Migrations\Migration;

class AddDescription extends Migration {

        /**
        * Run the migrations.
        */
        public function up()
        {
                //
                Schema::table('blog', function(\Illuminate\Database\Schema\Blueprint $table)
                {                   
                        $table->text("description");
                });
        }

        /**
        * Reverse the migrations.
        */
        public function down()
        {
                 Schema::table('blog', function(\Illuminate\Database\Schema\Blueprint $table)
                {                   
                        $table->dropColumn("description");
                });
        }

}