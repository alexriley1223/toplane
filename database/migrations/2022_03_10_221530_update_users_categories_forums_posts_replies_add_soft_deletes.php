<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersCategoriesForumsPostsRepliesAddSoftDeletes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->softDeletes($column = 'deleted_at');
        });
        Schema::table('categories', function (Blueprint $table) {
          $table->softDeletes($column = 'deleted_at');
        });
        Schema::table('forums', function (Blueprint $table) {
          $table->softDeletes($column = 'deleted_at');
        });
        Schema::table('posts', function (Blueprint $table) {
          $table->softDeletes($column = 'deleted_at');
        });
        Schema::table('replies', function (Blueprint $table) {
          $table->softDeletes($column = 'deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->dropColumn('deleted_at');
        });
        Schema::table('categories', function (Blueprint $table) {
          $table->dropColumn('deleted_at');
        });
        Schema::table('forums', function (Blueprint $table) {
          $table->dropColumn('deleted_at');
        });
        Schema::table('posts', function (Blueprint $table) {
          $table->dropColumn('deleted_at');
        });
        Schema::table('replies', function (Blueprint $table) {
          $table->dropColumn('deleted_at');
        });
    }
}
