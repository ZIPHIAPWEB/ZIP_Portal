<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SuperadminStudentResource extends JsonResource
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
            'user_id' => $this->id,
            'email' => $this->email,
            'username' => $this->name,
            'is_verified' => (bool) $this->verified,
            'is_filled' => (bool) $this->isFilled,
            'registered_at' => $this->created_at->toFormattedDayDateString()
        ];
    }
}
