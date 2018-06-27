<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';
    protected $fillable = ['name', 'slug_name', 'type', 'created_at', 'updated_at'];
    public $timestamps = true;
}
