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
            'user_id' => $this->id,
            'first_name' => $this->coordinator->firstName,
            'middle_name' => $this->coordinator->middleName ?? '',
            'last_name' => $this->coordinator->lastName,
            'program' => $this->coordinator->program ?? 'n/a',
            'position' => $this->coordinator->position ?? 'n/a',
            'contact' => $this->coordinator->contact ?? 'n/a',
            'registered_at' => $this->coordinator->created_at->toFormattedDayDateString()
        ];
    }
}
