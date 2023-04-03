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
    return [
        'id' => $this->id,
        'busId' => $this->busId,
        'name' => $this->name,
    ];
}

}
