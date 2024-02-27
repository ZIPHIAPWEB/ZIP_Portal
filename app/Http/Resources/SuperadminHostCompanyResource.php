<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SuperadminHostCompanyResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->state,
            'created_at' => $this->created_at->toFormattedDayDateString()
        ];
    }
}
