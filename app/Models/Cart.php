<?php

namespace App\Models;

use App\Traits\BelongsToProduct;
use App\Traits\BelongsToProductVariety;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory, BelongsToUser, BelongsToProduct, BelongsToProductVariety;

    protected $fillable = [
        'user_id',
        'product_id',
        'product_variety_id',
        'qty',
    ];
}