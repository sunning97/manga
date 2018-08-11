<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('f_name');
            $table->string('l_name');
            $table->string('email');
            $table->unique('email');
            $table->date('birth_date')->nullable();
            $table->string('phone','20')->nullable();
            $table->string('password');
            $table->enum('gender',['MALE','FEMALE']);
            $table->text('address')->nullable();
            $table->string('avatar');
            $table->enum('state',['ACTIVE','INACTIVE','BANNED'])->default('INACTIVE');
            $table->enum('banned',['T','F'])->default('F');
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
