<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectCourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_cource', function (Blueprint $table) {
            $table->unsignedInteger('subject_id');
            $table->unsignedInteger('cource_id');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('cource_id')->references('id')->on('cources');
            $table->primary(['subject_id','cource_id']);
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
        Schema::dropIfExists('subject_cource');
    }
}
