<?php 

namespace App\Traits;

use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyProduct {

    /**
     * model has many products
     *
     * @return BelongsTo
     */
    public function products():HasMany
    {
        return $this->hasMany(Product::class);
    }
}