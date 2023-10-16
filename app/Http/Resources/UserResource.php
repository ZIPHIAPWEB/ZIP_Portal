<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

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
            'email' => $this->email,
            'profile_picture' => $this->profile_picture ?? URL::asset('logo.png'),
            'is_verified' => (bool) $this->verified,
            'is_filled' => (bool) $this->isFilled,
            'date_registered' => $this->created_at->toDateTimeString(),
            'application_status' => $this->student->application_status ?? "",
            'application_id' => $this->student->application_id ?? "",
            'program' => $this->student->program->display_name ?? ""
        ];
    }
}
