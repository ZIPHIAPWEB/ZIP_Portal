<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentVIsaInterviewResource extends JsonResource
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
            'program_id_number' => $this->program_id_number,
            'sevis_id' => $this->sevis_id,
            'visa_interview_schedule' => $this->visa_interview_schedule,
            'visa_interview_time' => $this->visa_interview_time,
            'trial_interview_schedule' => $this->trial_interview_schedule,
            'trial_interview_time' => $this->trial_interview_time
        ];
    }
}
