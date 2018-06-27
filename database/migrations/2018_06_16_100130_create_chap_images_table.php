<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChapImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chap_images', function (Blueprint $table) {
        $table->increments('id');
        $table->unsignedInteger('chap_id');
        $table->text('image');
        $table->integer('order')->default('0');
        $table->foreign('chap_id')->references('id')->on('chaps')->onDelete('cascade');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chap_images');
    }
}
