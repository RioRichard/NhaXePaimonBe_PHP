<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ManagerResource extends JsonResource
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
        'userName' => $this->userName,
        'email' => $this->email,
        'password' => $this->password,
        'name' => $this->name,
        'phone' => $this->phone,
        'role' => $this->role
    ];
}

}
