<?php

namespace App\Http\Resources\Request;

use Illuminate\Http\Resources\Json\JsonResource;

class RequestResource extends JsonResource
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
            'user' => $this->user->full_name,
            'service' => $this->service->name,
            'company' => $this->company,
            'message' => $this->message,
            'target_date' => $this->target_date,
            'file_link' => $this->file_link,
            'is_reviewed' => $this->is_reviewed,
            'created_at' => $this->created_at,
        ];
    }
}