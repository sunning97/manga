<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table='authors';
    protected $fillable=['name','slug_name','description','created_at','updated_at'];
    public $timestamps=true;
}
