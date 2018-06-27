<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table='permissions';
    protected $fillable = ['name','slug_name','description','created_at','updated_at'];
    public $timestamps=true;

    public function role(){
        return $this->belongsToMany('App\Models\Role','role_permission','permission_id','role_id');
    }
}
