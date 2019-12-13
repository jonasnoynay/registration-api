<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $table = 'participants';
    
    protected $fillable = [
        'fullname',
        'winner',
    ];

    public $timestamps = false;

    const   WINNER_TRUE = 1,
            WINNER_FALSE = 0;

    /**
     * is_registered attribute
     *
     * @return string
     */
    public function getIsWinnerAttribute()
    {
        return $this->winner == $this::WINNER_TRUE ? 'Yes' : 'No';
    }
}