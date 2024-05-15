<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'transaction_no' => $this->transaction_no,
            'reference_no' => $this->reference_no,
            'customer' => $this->user->full_name,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}