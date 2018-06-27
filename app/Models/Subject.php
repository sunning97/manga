<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table='subjects';
    protected $fillable=['name'];

    public function cources()
    {
        return $this->belongsToMany('App\Models\Cource','subject_cource');
    }
}
