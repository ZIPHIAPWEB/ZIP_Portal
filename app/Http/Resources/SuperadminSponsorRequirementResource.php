<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SuperadminSponsorRequirementResource extends JsonResource
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
            'description' => $this->description,
            'path' => $this->path,
            'is_active' => (bool) $this->is_active,
            'sponsor_id' => $this->sponsor->id ?? '',
            'sponsor' => ucfirst($this->sponsor->name) ?? '',
            'created_at' => $this->created_at->toFormattedDayDateString()
        ];
    }
}
