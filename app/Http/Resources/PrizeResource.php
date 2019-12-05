<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\PreregisteredResource;

class PrizeResource extends Resource
{
    /**
     * Resource type
     *
     * @var string
     */
    protected $resource_type = 'prizes';

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
                    'name' => $this->name,
                    'available' => $this->available,
                    'won' => $this->won
                ]
        ];
    }
}
