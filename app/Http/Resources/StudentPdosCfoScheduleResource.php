<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentPdosCfoScheduleResource extends JsonResource
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
            'pdos_schedule' => $this->pdos_schedule,
            'formatted_pdos_schedule' => $this->pdos_schedule ? Carbon::parse($this->pdos_schedule)->toFormattedDateString() : "",
            'pdos_schedule_time' => $this->pdos_schedule_time,
            'cfo_schedule' => $this->cfo_schedule,
            'formatted_cfo_schedule' => $this->cfo_schedule ? Carbon::parse($this->cfo_schedule)->toFormattedDateString() : "",
            'cfo_schedule_time' => $this->cfo_schedule_time
        ];
    }
}
