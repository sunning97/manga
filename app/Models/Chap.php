<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Chap extends Model
{
    protected $table='chaps';
    protected $fillable=['name','slug_name','manga_id','created_at','updated_at','post_by','update_by'];
    public $timestamps=true;

    public function format_time($time)
    {
        return $time->format('d-m-Y , H:i');
    }

    public function postBy(){
        return $this->hasOne('App\Models\Admin','id','post_by');
    }

    public function updateBy(){
        return $this->hasOne('App\Models\Admin','id','update_by');
    }

    public function images(){
        return $this->hasMany('App\Models\ChapImage','chap_id','id');
    }

    public function manga(){
        return $this->belongsTo('App\Models\Manga','manga_id','id');
    }
}
