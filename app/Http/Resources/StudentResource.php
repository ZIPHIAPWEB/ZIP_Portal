<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'id' => $this->id,
            'gender' => $this->student->gender,
            'permanent_address' => $this->student->permanent_address,
            'provincial_address' => $this->student->provincial_address,
            'home_number' => $this->student->home_number,
            'mobile_number' => $this->student->mobile_number,
            'year' => $this->student->year,
            'skype_id' => $this->student->skype_id,
            'program_id_no' => $this->student->program_id_no,
            'sevis_id' => $this->student->sevis_id,
            'personal' => [
                'first_name' => $this->student->first_name,
                'middle_name' => $this->student->middle_name,
                'last_name' => $this->student->last_name,
                'birthdate' => $this->student->birthdate,

            ]
        ];
    }
}
