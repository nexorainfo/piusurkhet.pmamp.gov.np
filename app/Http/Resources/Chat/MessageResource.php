<?php

namespace App\Http\Resources\Chat;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id ?? '',
            'sender_id' => $this->sender_id ?? '',
            'message' => $this->message ?? '',
            'receiver_id' => $this->receiver_id ?? '',
            'created_at' => $this->created_at->timezone('Asia/Kathmandu')->locale('en')->calendar()
        ];
    }
}
