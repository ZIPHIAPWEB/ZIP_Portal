<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentPersonalResource extends JsonResource
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
            'first_name' => $this->student->first_name,
            'middle_name' => $this->student->middle_name,
            'last_name' => $this->student->last_name,
            'birthdate' => Carbon::parse($this->student->birthdate)->toFormattedDateString(),
            'gender' => $this->student->gender,
            'skype_id' => $this->student->skype_id,
            'fb_email' => $this->student->fb_email
        ];
    }
}
