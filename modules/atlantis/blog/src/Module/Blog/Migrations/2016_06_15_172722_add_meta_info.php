<?php

use Illuminate\Database\Migrations\Migration;

class AddMetaInfo extends Migration {

        /**
        * Run the migrations.
        */
        public function up()
        {
                //
                Schema::table('blog', function(\Illuminate\Database\Schema\Blueprint $table)
                {                   
                        $table->string("seo_title");
                        $table->string("meta_description");
                });
        }

        /**
        * Reverse the migrations.
        */
        public function down()
        {
                 Schema::table('blog', function(\Illuminate\Database\Schema\Blueprint $table)
                {                   
                        $table->dropColumn("seo_title");
                        $table->dropColumn("meta_description");
                });
        }

}