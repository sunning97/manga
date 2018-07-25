<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table='messages';
    protected $fillable=['sent_from','sent_to','created_at','content','readed','updated_at'];
}
