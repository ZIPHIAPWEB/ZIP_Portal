<?php

namespace App\Http\Resources\flight;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentArrivalToUsResource extends JsonResource
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
            'us_arrival_date' => $this->us_arrival_date,
            'us_arrival_time' => $this->us_arrival_time,
            'us_arrival_flight_no' => $this->us_arrival_flight_no,
            'us_arrival_airline' => $this->us_arrival_airline,
        ];
    }
}
