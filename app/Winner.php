<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    protected $table = 'winners';
    
    protected $fillable = [
        'preregistered_id', 'prize_id'
    ];

    public $timestamps = false;
}