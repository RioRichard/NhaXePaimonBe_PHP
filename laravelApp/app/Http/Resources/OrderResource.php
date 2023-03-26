<?php

namespace App\Http\Resources;
use App\Models\Route;
use App\Models\User;

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
        $routeId = Route::find($this->routeId);
        $userId = User::find($this->userId);
  
    return [
        'id' => $this->id,
        'userId' => $userId,
        'routeId' => $routeId,
        'seatsId' => $this->seatsId,
        'status' => $this->status,
        'paymentInfo' => $this->paymentInfo,
        'promoteId' => $this->promoteId
    ];
    }
}
