<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
        'username' => $this->username,
        'email' => $this->email,
        'password' => $this->password,
        'name' => $this->name,
        'phone' => $this->phone
    ];
}

}
