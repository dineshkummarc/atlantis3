<?php

use Illuminate\Database\Migrations\Migration;

class CreateBlogTable extends Migration {

        /**
        * Run the migrations.
        */
        public function up()
        {
                //
                Schema::table('blog', function(\Illuminate\Database\Schema\Blueprint $table)
                {                   
                        $table->integer("gallery_id");
                });
        }

        /**
        * Reverse the migrations.
        */
        public function down()
        {
                 Schema::table('blog', function(\Illuminate\Database\Schema\Blueprint $table)
                {                   
                        $table->dropColumn("gallery_id");
                });
        }

}