<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd($this->all());
        return [
            "id"=> $this->id,
            "content"=> $this->content,
            "image"=> $this->image,
            "sender_id"=> $this->sender_id,
            "receiver_id"=> $this->receiver_id,
            'favorite'=> $this->favorite,
            "created_at"=> $this->created_at,
        ];
    }
}
