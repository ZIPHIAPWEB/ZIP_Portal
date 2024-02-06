<?php

namespace App\Http\Resources\flight;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentDepartFromManilaResource extends JsonResource
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
            'mnl_departure_date' => $this->mnl_departure_date,
            'mnl_departure_time' => $this->mnl_departure_time,
            'mnl_departure_flight_no' => $this->mnl_departure_flight_no,
            'mnl_departure_airline' => $this->mnl_departure_airline,
        ];
    }
}
