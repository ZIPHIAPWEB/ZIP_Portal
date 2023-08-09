<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TertiaryResource extends JsonResource
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
            'id' => $this->tertiary->id,
            'school' => $this->tertiary->school->name ?? '',
            'school_id' => $this->tertiary->id,
            'address' => $this->tertiary->address,
            'degree' => $this->tertiary->degree,
            'start_date' => $this->tertiary->start_date,
            'date_graduated' => $this->tertiary->date_graduated
        ];
    }
}
