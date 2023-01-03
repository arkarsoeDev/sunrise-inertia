<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FineResource extends JsonResource
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
            "id" => $this->id,
            "loan_id" => $this->loan_id,
            "member_id" => $this->member_id,
            "fine_amount" => $this->fine_amount,
            "paid" => $this->paid,
            "fine_date" => strtotime($this->fine_date)
        ];
    }
}
