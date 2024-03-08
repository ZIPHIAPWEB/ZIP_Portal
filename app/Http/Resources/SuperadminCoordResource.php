<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SuperadminCoordResource extends JsonResource
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
            'id' => $this->coordinator->id ?? '',
            'user_id' => $this->id,
            'email' => $this->email,
            'username' => $this->name,
            'first_name' => $this->coordinator->firstName ?? '',
            'middle_name' => $this->coordinator->middleName ?? '',
            'last_name' => $this->coordinator->lastName ?? '',
            'program' => $this->coordinator->selectedProgram->display_name ?? 'n/a',
            'position' => $this->coordinator->position ?? 'n/a',
            'contact' => $this->coordinator->contact ?? 'n/a',
            'is_activated' => (bool) $this->verified,
            'registered_at' => $this->created_at->toFormattedDayDateString()
        ];
    }
}
