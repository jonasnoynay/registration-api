<?php

namespace App\Http\Resources;

use App\Http\Resources\TeamResource;
use App\Http\Resources\PositionResource;
use App\Http\Resources\DepartmentResource;
use App\Http\Resources\EmploymentResource;
use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\EmployeeDetailResource;
use App\Http\Resources\EmployeeEducationResource;
use App\Http\Resources\EmployeeEmergencyContactResource;

class ParticipantResource extends Resource
{
    /**
     * Resource type
     *
     * @var string
     */
    protected $resource_type = 'participants';

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
                    'firstname' => $this->firstname,
                    'lastname' => $this->lastname
                ]
        ];
    }
}
