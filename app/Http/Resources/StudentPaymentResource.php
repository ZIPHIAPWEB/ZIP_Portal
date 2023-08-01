<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class StudentPaymentResource extends JsonResource
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
            'user' => new UserResource($this->user),
            'requirement' => $this->payment,
            'bank_code' => $this->bank_code,
            'reference_no' => $this->reference_no,
            'date_deposit' => $this->date_deposit,
            'bank_account_no' => $this->bank_account_no,
            'amount' => $this->amount,
            'status' => $this->status,
            'acknowledgement' => $this->acknowledgement,
            'path' => $this->path,
            'created_at' => $this->created_at,
        ];
    }
}
