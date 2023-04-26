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
            'id' => $this->id,
            'school' => $this->school->name,
            'address' => $this->address,
            'degree' => $this->degree,
            'start_date' => $this->start_date,
            'date_graduated' => $this->date_graduated
        ];
    }
}
