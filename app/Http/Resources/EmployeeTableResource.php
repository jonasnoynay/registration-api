<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class EmployeeTableResource extends Resource
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
                    'ID Number' => $this->idnumber,
                    'Fullname' => $this->fullname,
                    'Date Hired' => $this->date_hired,
                    'Registered' => $this->is_registered
                ]
        ];
    }
}
