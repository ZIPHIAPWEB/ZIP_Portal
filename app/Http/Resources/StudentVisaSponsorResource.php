<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentVisaSponsorResource extends JsonResource
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
            'visa_sponsor' => $this->sponsor->name,
            'host_company' => $this->company->name,
            'housing_address' => $this->housing_details,
            'position' => $this->position,
            'stipend' => $this->stipend,
            'start_date' => $this->program_start_date,
            'formatted_start_date' => $this->program_start_date ? Carbon::make($this->program_start_date)->toFormattedDateString() : "",
            'end_date' => $this->program_end_date,
            'formatted_end_date' => $this->program_end_date ? Carbon::make($this->program_end_date)->toFormattedDateString() : "",
        ];
    }
}
