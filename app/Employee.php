<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    
    protected $fillable = [
        'idnumber', 'fullname', 'hiredate', 'regdate', 'empstatus', 'cellnumber', 'emailaddress'
    ];

    public $timestamps = false;
}