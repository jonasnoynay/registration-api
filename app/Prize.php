<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    protected $table = 'prizes';
    
    protected $fillable = [
        'name', 'available', 'won'
    ];

    public $timestamps = false;

    /**
     * Get Winner
     *
     */
    public function winner()
    {
        return $this->hasOneThrough('App\Preregistered', 'App\Winner', 'prize_id', 'id', 'id', 'preregistered_id');
    }
}