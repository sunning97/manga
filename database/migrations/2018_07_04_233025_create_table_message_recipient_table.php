<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMessageRecipientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_recipient', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('recipient');
            $table->string('recipient_group','10');
            $table->unsignedInteger('message');
            $table->foreign('recipient')->references('id')->on('admins');
            $table->foreign('recipient_group')->references('id')->on('admin_group');
            $table->foreign('message')->references('id')->on('messages');
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
        Schema::dropIfExists('message_recipient');
    }
}
