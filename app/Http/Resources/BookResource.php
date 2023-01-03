<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            "title" => $this->title,
            "publication_date" => strtotime($this->publication_date),
            "copies_owned" => $this->copies_owned,
            "available" => $this->available,
            "created_at" => strtotime($this->created_at),
        ];
    }
}
