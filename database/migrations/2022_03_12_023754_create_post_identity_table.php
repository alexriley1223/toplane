<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostIdentityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_identity');
    }
}
