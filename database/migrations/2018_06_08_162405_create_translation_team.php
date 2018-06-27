<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslationTeam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translate_teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug_name');
            $table->text('description');
            $table->text('avatar');
            $table->unsignedInteger('leader_id')->nullable();
            $table->foreign('leader_id')->references('id')->on('users');
            $table->enum('state',['ACTIVATE','INACTIVE'])->default('ACTIVATE');
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
        Schema::dropIfExists('translate_team');
    }
}
