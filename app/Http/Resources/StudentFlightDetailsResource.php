<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentFlightDetailsResource extends JsonResource
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

            'us_arrival_date' => $this->us_arrival_date,
            'us_arrival_time' => $this->us_arrival_time,
            'us_arrival_flight_no' => $this->us_arrival_flight_no,
            'us_arrival_airline' => $this->us_arrival_airline,

            'us_departure_date' => $this->us_departure_date,
            'us_departure_time' => $this->us_departure_time,
            'us_departure_flight_no' => $this->us_departure_flight_no,
            'us_depature_airline' => $this->us_departure_airline,

            'mnl_arrival_date' => $this->mnl_arrival_date,
            'mnl_arrival_time' => $this->mnl_arrival_time,
            'mnl_arrival_flight_no' => $this->mnl_arrival_flight_no,
            'mnl_arrival_airline' => $this->mnl_arrival_airline
        ];
    }
}
