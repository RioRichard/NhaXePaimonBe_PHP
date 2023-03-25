<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
        'userId' => $this->userId,
        'routeId' => $this->routeId,
        'seatsId' => $this->seatsId,
        'status' => $this->status,
        'paymentInfo' => $this->paymentInfo,
        'promoteId' => $this->promoteId
    ];
    }
}
