<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->user_id,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'fb_username' => $this->fb_username,
            'user' => new UserResource($this->whenLoaded('user'))
        ];
    }
}
