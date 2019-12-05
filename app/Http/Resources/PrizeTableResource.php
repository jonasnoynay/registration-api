<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PrizeTableResource extends Resource
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
                    'Name' => $this->name,
                    'Quantity Available' => $this->available
                ]
        ];
    }
}
