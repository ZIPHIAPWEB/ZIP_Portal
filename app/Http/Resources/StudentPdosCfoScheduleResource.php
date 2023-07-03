<?php

namespace App\Http\Resources;

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
            'pdos_schedule_time' => $this->pdos_schedule_time,
            'cfo_schedule' => $this->cfo_schedule,
            'cfo_schedule_time' => $this->cfo_schedule_time
        ];
    }
}
