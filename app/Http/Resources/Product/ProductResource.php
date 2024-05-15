<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'supplier' => $this->supplier->company,
            'category' => $this->category->name,
            'brand' => $this->brand->name,
            'slug' => $this->slug,
            'name' => $this->name,
            'qty' => filled($this->qty) ? $this->qty : $this->varieties->sum('qty'),
            'is_customized' => $this->is_customized,
            'is_available' => $this->is_available,
            'updated_at' => $this->updated_at?->diffForHumans(),
            'featured_photo' => $this->featured_photo,
        ];
    }
}