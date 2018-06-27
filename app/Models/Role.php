<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['name','slug_name','description','level','created_at','updated_at'];
    public $timestamps=true;


    public function permission(){
        return $this->belongsToMany('App\Models\Permission','role_permission','role_id','permission_id');
    }

    public function admin(){
        return $this->belongsToMany('App\Models\Admin','admin_role','admin_id','role_id');
    }
}
