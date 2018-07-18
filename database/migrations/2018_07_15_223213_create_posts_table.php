<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      // Here it creates a Post table to be created when the DBMigrate command is run
      // the ones that follow in the command are the columns
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id'); //ID as primary key
            $table->string ('title');//title column
            $table->mediumText('body');//long texts (body of posts column)
            $table->timestamps();//two columns; created at and updated at when making changes to a post or create
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
