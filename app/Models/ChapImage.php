<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChapImage extends Model
{
    protected $table ='chap_images';
    protected $fillable=['chap_id','image','order','created_at','updated_at'];
    public $timestamps=true;

    public function chap(){
        return $this->belongsTo('App\Models\Chap','chap_id','id');
    }
}
