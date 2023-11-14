<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExportStudentResource extends JsonResource
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
            'application_id' => $this->application_id,
            'data_of_payment'=> $this->studentPayment()->first()->created_at ?? '',
            'first_name' => $this->first_name,
            'middle_name'=> $this->middle_name,
            'last_name' =>  $this->last_name,
            'school' => $this->user->tertiary->school->name,
            'course' => $this->user->tertiary->degree,
            'date_graduated' => $this->user->tertiary->date_graduated,
            'contact_number' => $this->mobile_number . '/' . $this->home_number,
            'permanent_address' => $this->permanent_address,
            'email' => $this->user->email,
            'skype_id' => $this->skype_id,
            'fb_email' => $this->fb_email,
            'birth_date' => $this->birthdate,
            'status' => $this->application_status,
            'sponsor' => $this->company->name,
            'position' => $this->position,
            'location' => $this->location,
            'start_date' => $this->program_start_date,
            'end_date' => $this->program_end_date,
            'sponsor' => $this->sponsor->name,
        ];
    }
}
