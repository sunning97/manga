<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_group', function (Blueprint $table) {
            $table->string('id','10')->unique();
            $table->unsignedInteger('admin_id');
            $table->unsignedInteger('group_id');
            $table->foreign('admin_id')->references('id')->on('admins');
            $table->foreign('group_id')->references('id')->on('groups_chat');
            $table->primary(['admin_id','group_id','id']);
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
        Schema::dropIfExists('admin_group');
    }
}
