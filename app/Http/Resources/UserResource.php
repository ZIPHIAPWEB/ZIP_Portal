<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->name,
            'full_name' => $this->student->first_name . ' ' . $this->student->middle_name . ' ' . $this->student->last_name,
            'email' => $this->email,
            'profile_picture' => $this->profile_picture,
            'is_verified' => $this->verified,
            'is_filled' => $this->isFilled,
            'date_registered' => $this->created_at->toDateTimeString()
        ];
    }
}
