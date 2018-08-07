<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMangasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mangas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('other_name');
            $table->string('slug_name');
            $table->enum('state',['COMPLETE','IN_PROCESS','HIDDEN'])->default('IN_PROCESS');
            $table->decimal('view',10)->default(0);
            $table->text('cover');
            $table->text('description');
            $table->text('second_des')->nullable();
            $table->unsignedInteger('post_by');
            $table->foreign('post_by')->references('id')->on('admins');
            $table->text('origin')->nullable();
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
        Schema::dropIfExists('mangas');
    }
}
