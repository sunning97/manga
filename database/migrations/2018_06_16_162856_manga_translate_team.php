<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MangaTranslateTeam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manga_translate_team', function (Blueprint $table) {
            $table->unsignedInteger('manga_id');
            $table->unsignedInteger('team_id');
            $table->foreign('manga_id')->references('id')->on('mangas');
            $table->foreign('team_id')->references('id')->on('translate_teams');
            $table->primary(['manga_id','team_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manga_translate_team');
    }
}
