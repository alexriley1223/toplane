<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCategoriesPostsForumsAddSlugs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
          $table->string('slug')->after('order')->unique();
        });
        Schema::table('forums', function (Blueprint $table) {
          $table->string('slug')->after('category_id')->unique();
        });
        Schema::table('posts', function (Blueprint $table) {
          $table->string('slug')->after('forum_id')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
          $table->dropColumn('slug');
        });
        Schema::table('forums', function (Blueprint $table) {
          $table->dropColumn('slug');
        });
        Schema::table('posts', function (Blueprint $table) {
          $table->dropColumn('slug');
        });
    }
}
