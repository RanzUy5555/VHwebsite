<?php

namespace App\Models;

use App\Traits\BelongsToProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductVariety extends Model
{
    use HasFactory, BelongsToProduct;

    protected $fillable = [
        'product_id', 
        'name', 
        'price',
        'qty'
    ];

    // ==============================Relationship==================================================

    public function carts():HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function orders():HasMany
    {
        return $this->hasMany(Order::class);
    }

}