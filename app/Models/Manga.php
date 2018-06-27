<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    protected $table='mangas';
    protected $fillable = ['name','other_name','slug_name','state','view','origin','cover','description','post_by','genre_id','update_by','created_at','updated_at'];
    public $timestamps=true;

    public function genres(){
        return $this->belongsToMany('App\Models\Genre','manga_genre','manga_id','genre_id');
    }

    public function authors(){
        return $this->belongsToMany('App\Models\Author','manga_author','manga_id','author_id');
    }
    public function chaps(){
        return $this->hasMany('App\Models\Chap','manga_id');
    }

    public function admins(){
        return $this->belongsToMany('App\Models\Admin','manga_admin','manga_id','admin_id');
    }

    public function teams(){
        return $this->belongsToMany('App\Models\TranslateTeam','manga_translate_team','manga_id','team_id');
    }
}
