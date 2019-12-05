<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $table = 'participants';
    
    protected $fillable = [
        'firstname', 'lastname'
    ];

    public $timestamps = false;
}