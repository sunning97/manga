<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetPassword;
use Illuminate\Support\Facades\Cache;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';
    protected $table = 'admins';
    protected $fillable = ['f_name', 'l_name', 'email', 'password', 'gender', 'address', 'avatar','birth_date','phone','banned'];
    public $timestamps = true;
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->belongsToMany('App\Models\Role','admin_role','admin_id','role_id');
    }

    public function hasPermission($name){
        return !! optional(optional($this->role())->first()->permission())->whereSlug_name($name)->first();
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPassword($token));
    }
    public function isOnline()
    {
        return Cache::has('user-online-'.$this->id);
    }

    public function fullName($id)
    {
        return Admin::findOrFail($id)->f_name.' '.Admin::findOrFail($id)->l_name;
    }

    public function getNameSlug($id)
    {
        return str_slug(Admin::findOrFail($id)->f_name. " " .Admin::findOrFail($id)->l_name);
    }
}
