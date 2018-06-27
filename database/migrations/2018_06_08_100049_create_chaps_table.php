<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('chaps', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('slug_name');
        $table->unsignedInteger('manga_id');
        $table->foreign('manga_id')->references('id')->on('mangas')->onDelete('cascade');
        $table->unsignedInteger('post_by');
        $table->foreign('post_by')->references('id')->on('admins');
        $table->unsignedInteger('update_by')->nullable();
        $table->foreign('update_by')->references('id')->on('admins');
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
        Schema::dropIfExists('chaps');
    }
}
