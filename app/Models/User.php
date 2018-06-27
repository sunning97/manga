<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table='users';
    protected $fillable=['f_name','l_name','email','birth_date','phone','address','avatar','gender','created_at','updated_at'];
    public $timestamps=true;

    protected $hidden = [
        'password'
    ];
}
