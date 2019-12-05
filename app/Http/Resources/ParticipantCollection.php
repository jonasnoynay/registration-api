<?php

namespace App\Http\Resources;

use App\Http\Resources\ParticipantResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ParticipantCollection extends ResourceCollection
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
            'data' => ParticipantResource::collection($this->collection)
        ];
    }
}
