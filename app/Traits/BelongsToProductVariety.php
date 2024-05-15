<?php 

namespace App\Traits;

use App\Models\ProductVariety;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToProductVariety {

    /**
     * this model belongs to Product Variety
     *
     * @return BelongsTo
     */
    public function product_variety():BelongsTo
    {
        return $this->belongsTo(ProductVariety::class);
    }
}