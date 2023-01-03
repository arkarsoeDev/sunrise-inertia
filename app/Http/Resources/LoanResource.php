<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
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
            "member_id" => $this->member_id,
            "book_id" => $this->book_id,
            "duration" => $this->duration,
            "loan_date" => strtotime($this->loan_date),
            "return_date" => strtotime($this->return_date),
            "returned_date" => strtotime($this->returned_date),
            "fine" => new FineResource($this->fine),
        ];
    }
}
