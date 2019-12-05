<?php

namespace App\Http\Resources;

use App\Http\Resources\PreregisteredResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PreregisteredCollection extends ResourceCollection
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
            'data' => PreregisteredResource::collection($this->collection)
        ];
    }
}
