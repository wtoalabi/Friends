<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   /*  public function up()
    {
        Schema::create('profile_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('path')->default('default.jpg');            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    } */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    /* public function down()
    {
        Schema::dropIfExists('profile_images');
    } */
}
