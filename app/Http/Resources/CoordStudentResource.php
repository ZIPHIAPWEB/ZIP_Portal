<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CoordStudentResource extends JsonResource
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
            'id' => $this->user_id,
            'date_of_application' => $this->created_at->toFormattedDayDateString(),
            'application_status' => $this->application_status,
            'email' => $this->user->email,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'contact_no' => $this->mobile_number . '/' . $this->home_number,
            'school' => $this->user->tertiary->school_name,
            'program' => $this->program->name,
            'recent_action' => $this->user->logs()->orderBy('created_at', 'desc')->first()->activity ?? ""
        ];
    }
}
