<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PreregisteredResource extends Resource
{
    /**
     * Resource type
     *
     * @var string
     */
    protected $resource_type = 'preregistered';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
                'id'    => $this->id,
                'type'  => $this->resource_type,
                'attributes' =>
                [
                    'id_number' => $this->idnumber,
                    'firstname' => $this->firstname,
                    'lastname' => $this->lastname,
                    'hiredate' => $this->hiredate,
                    'regdate' => $this->regdate,
                    'empstatus' => $this->empstatus,
                    'cellnumber' => $this->cellnumber,
                    'emailaddress' => $this->emailaddress,
                    'registered' => $this->registered,
                    'is_registered' => $this->is_registered,
                    'date_hired' => $this->date_hired,
                ]
        ];
    }
}
