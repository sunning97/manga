<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table='genres';
    protected $fillable=['name','slug_name','description','created_at','updated_at'];
    public $timestamps = true;

    public function mangas(){
        return $this->belongsToMany('App\Models\Manga','manga_genre','genre_id','manga_id');
    }
}
