<?php

namespace App\Http\Resources;

use App\Http\Resources\flight\StudentArrivalToManilaResource;
use App\Http\Resources\flight\StudentArrivalToUsResource;
use App\Http\Resources\flight\StudentDepartFromManilaResource;
use App\Http\Resources\flight\StudentDepartFromUsResource;
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
            'mnl_depart' => new StudentDepartFromManilaResource($this),
            'us_arrival' => new StudentArrivalToUsResource($this),
            'us_depart' => new StudentDepartFromUsResource($this),
            'mnl_arrival' => new StudentArrivalToManilaResource($this)
        ];
    }
}
