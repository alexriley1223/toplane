<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForumsAddImageUrl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::table('forums', function (Blueprint $table) {
         $table->string('image_url')->after('order')->default('images/forums/forum.png');
       });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
       Schema::table('forums', function (Blueprint $table) {
         $table->dropColumn('image_url');
       });
     }
}
