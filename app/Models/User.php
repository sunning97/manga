<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guard = 'site';
    protected $table='users';
    protected $fillable=['f_name','l_name','email','birth_date','phone','address','avatar','state','gender','created_at','updated_at'];
    public $timestamps=true;

    protected $hidden = [
        'remember_token','password'
    ];

    public function fullName($id)
    {
        return User::find($id)->f_name. ' ' .User::find($id)->l_name;
    }
}
