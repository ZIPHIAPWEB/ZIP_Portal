<?php

namespace App\Http\Resources\flight;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentArrivalToManilaResource extends JsonResource
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
            'mnl_arrival_date' => $this->mnl_arrival_date,
            'mnl_arrival_time' => $this->mnl_arrival_time,
            'mnl_arrival_flight_no' => $this->mnl_arrival_flight_no,
            'mnl_arrival_airline' => $this->mnl_arrival_airline
        ];
    }
}
