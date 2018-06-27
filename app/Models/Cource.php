<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cource extends Model
{
    protected $table='cources';
    protected $fillable=['name'];

    public function subjects(){
        return $this->belongsToMany('App\Models\Subject','subject_cource');
    }
}
