<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    
    protected $fillable = [
        'idnumber', 'firstname', 'lastname', 'hiredate', 'regdate', 'empstatus', 'cellnumber', 'emailaddress'
    ];

    public $timestamps = false;
}