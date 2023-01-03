<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
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
            'book_id' => $this->book_id,
            'member_id' => $this->member_id,
            'active' => $this->active,
            'book_availabe' => $this->book->available,
            'reservation_date' => strtotime($this->reservation_date),
        ];
    }
}
