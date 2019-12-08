<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Preregistered extends Model
{
    protected $table = 'preregistered';
    
    protected $fillable = [
        'idnumber', 'fullname', 'registered'
    ];

    public $timestamps = false;

    const   REGISTERED_TRUE = 1,
             REGISTERED_FALSE = 0;

    /**
     * is_registered attribute
     *
     * @return string
     */
    public function getIsRegisteredAttribute()
    {
        return $this->registered == $this::REGISTERED_TRUE ? 'Yes' : 'No';
    }

    /**
     * date_hired attribute
     *
     * @return string
     */
    public function getDateHiredAttribute()
    {
        return Carbon::parse($this->hiredate)->format('F d, Y');
    }
}