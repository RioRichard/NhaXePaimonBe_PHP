<?php

namespace App\Http\Resources;

use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray($request)
    {
        $seat = Seat::where('busId',$this->id)->get();
    return [
        'id' => $this->id,
        'bus_number' => $this->bus_number,                  
        'type' => $this->type,
        'seats'=>$seat
    ];
}

}
