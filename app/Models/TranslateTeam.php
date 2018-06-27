<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TranslateTeam extends Model
{
    protected $table='translate_teams';
    protected $fillable=['name','description','leader_id','slug_name','avatar','state','created_at','updated_at'];
    public $timestamps=true;
}
