<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            'testing' => auth()->user()->getUserRole(),
            'visa_interview_status' => $this->visa_interview_status ? ucfirst($this->visa_interview_status) : 'Pending',
            'program_id_number' => $this->program_id_no,
            'sevis_id' => $this->sevis_id,
            'visa_interview_schedule' => $this->visa_interview_schedule,
            'formatted_visa_interview_schedule' => $this->visa_interview_schedule ? Carbon::parse($this->visa_interview_schedule)->toFormattedDateString() : "",
            'visa_interview_time' => $this->visa_interview_time,
            'trial_interview_schedule' => $this->trial_interview_schedule,
            'formatted_trial_interview_schedule' => $this->trial_interview_schedule ? Carbon::parse($this->trial_interview_schedule)->toFormattedDateString() : "",
            'trial_interview_time' => $this->trial_interview_time
        ];
    }
}
