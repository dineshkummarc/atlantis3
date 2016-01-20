<?php


use Illuminate\Database\Migrations\Migration;

class CreateBlogTable extends Migration {

        /**
        * Run the migrations.
        */
        public function up()
        {
                //
                Schema::create('blog', function(\Illuminate\Database\Schema\Blueprint $table)
                {
                        $table->increments('id');
                        $table->string("title");
                        $table->text("description");
                                
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