<?php

namespace App\Http\Resources;

use App\Models\Base;
use App\Models\Bus;
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
        $bus = Bus::find($this->bus);
        $fromId = Base::find($this->fromId);
        $toId = Base::find($this->toId);
    return [
        'id' => $this->id,
        'fromId' => $fromId,
        'toId' => $toId,
        'departure' => $this->departure,
        'arrival' => $this->arrival,
        'bus' => $bus,
        'driver' => $this->driver,
        'extraStaff' => $this->extraStaff,
        'price' => $this->price,
        'status' => $this->status,
    ];
}

}
