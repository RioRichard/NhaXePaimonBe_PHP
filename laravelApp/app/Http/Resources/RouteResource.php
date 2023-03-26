<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RouteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray($request)
    {
    return [
        'id' => $this->id,
        'fromId' => $this->fromId,
        'toId' => $this->toId,
        'departure' => $this->departure,
        'arrival' => $this->arrival,
        'bus' => $this->bus,
        'driver' => $this->driver,
        'extraStaff' => $this->extraStaff,
        'price' => $this->price,
        'status' => $this->status,
    ];
}

}
