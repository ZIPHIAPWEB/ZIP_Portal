<?php

namespace App\Http\Resources\flight;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentDepartFromUsResource extends JsonResource
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
            'us_departure_date' => $this->us_departure_date,
            'us_departure_time' => $this->us_departure_time,
            'us_departure_flight_no' => $this->us_departure_flight_no,
            'us_departure_airline' => $this->us_departure_airline,
        ];
    }
}
