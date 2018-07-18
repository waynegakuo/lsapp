<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToPosts extends Migration
{
    /**
     * Run the migrations. (Adds the column to posts to table)
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function($table){
          $table->integer('user_id');
        });
    }

    /**
     * Reverse the migrations. (Deletes the column from posts table when called)
     *
     * @return void
     */
    public function down()
    {
      Schema::table('posts', function($table){
        $table->dropColumn('user_id');
      });
    }
}
