<?php

namespace App\Http\Resources;

use App\Http\Resources\PrizeResource;
use App\Http\Resources\PrizeCollection;
use Illuminate\Http\Resources\Json\Resource;

class CategoryResource extends Resource
{
    /**
     * Resource type
     *
     * @var string
     */
    protected $resource_type = 'categories';

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
                    'prizes' => new PrizeCollection($this->whenLoaded('prizes'))
                ]
        ];
    }
}
