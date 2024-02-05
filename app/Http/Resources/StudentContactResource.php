<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentContactResource extends JsonResource
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
            'provincial_address' => $this->provincial_address,
            'permanent_address' => $this->permanent_address,
            'home_number' => $this->home_number,
            'mobile_number' => $this->mobile_number
        ];
    }
}
