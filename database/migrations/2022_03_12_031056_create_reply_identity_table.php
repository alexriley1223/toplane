<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplyIdentityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reply_identity');
    }
}
