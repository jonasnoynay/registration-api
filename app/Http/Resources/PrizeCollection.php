<?php

namespace App\Http\Resources;

use App\Http\Resources\PrizeResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PrizeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => PrizeResource::collection($this->collection)
        ];
    }
}
