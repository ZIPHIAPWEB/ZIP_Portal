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
            'housing_address' => $this->location,
            'position' => $this->position,
            'stipend' => $this->stipend,
            'start_date' => Carbon::make($this->program_start_date)->toFormattedDateString(),
            'end_date' => Carbon::make($this->program_end_date)->toFormattedDateString()
        ];
    }
}
