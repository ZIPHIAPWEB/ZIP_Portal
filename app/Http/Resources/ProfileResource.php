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
            'personal' => [
                'first_name' => $this->student->first_name,
                'middle_name' => $this->student->middle_name,
                'last_name' => $this->student->last_name,
                'birthdate' => $this->student->birthdate,
                'gender' => $this->student->gender,
                'skype_id' => $this->student->skype_id,
                'fb_email' => $this->student->fb_email
            ],
            'education' => [
                'tertiary' => new TertiaryResource($this->tertiary),
                'secondary' => $this->student->secondary
            ],
            'contact' => [
                'provincial_address' => $this->student->provincial_address,
                'permanent_address' => $this->student->permanent_address,
                'home_number' => $this->student->home_number,
                'mobile_number' => $this->student->mobile_number
            ],
            'family' => [
                'father' => $this->student->father,
                'mother' => $this->student->mother
            ],
            'experience' => $this->student->experience
        ];
    }
}
