<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('f_name');
            $table->string('l_name');
            $table->string('email');
            $table->unique('email');
            $table->enum('gender',['MALE','FEMALE']);
            $table->date('birth_date')->nullable()->nullable();
            $table->string('phone',20)->nullable();
            $table->string('job')->nullable();
            $table->string('address')->nullable();
            $table->string('skypeId','255')->nullable();
            $table->string('website','255')->nullable();
            $table->string('password','255');
            $table->text('avatar');
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
        Schema::dropIfExists('users');
    }
}
