<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropIdentityTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::dropIfExists('reply_identity');
      Schema::dropIfExists('post_identity');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Data loss, but columns will be back
        Schema::create('post_identity', function (Blueprint $table) {
            $table->id();
            $table->string('identity');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('forum_id');
            $table->timestamps();
        });

        Schema::table('post_identity', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('forum_id')->references('id')->on('forums')->onDelete('cascade');
        });

        Schema::create('reply_identity', function (Blueprint $table) {
            $table->id();
            $table->string('identity');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('post_id');
            $table->timestamps();
        });

        Schema::table('reply_identity', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }
}
