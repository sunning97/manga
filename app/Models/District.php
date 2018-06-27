<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    protected $fillable = ['name', 'slug_name', 'type', 'province_id', 'created_at', 'updated_at'];
    public $timestamps = true;
}
