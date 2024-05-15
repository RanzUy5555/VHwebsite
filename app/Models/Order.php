<?php

namespace App\Models;

use App\Traits\BelongsToMunicipality;
use App\Traits\BelongsToUser;
use App\Traits\BelongsToProduct;
use App\Traits\BelongsToProductVariety;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model implements HasMedia
{
    use HasFactory, 
    BelongsToUser, 
    BelongsToProduct, 
    BelongsToMunicipality, 
    BelongsToProductVariety,
    InteractsWithMedia;

    public const PENDING = 0;
    public const APPROVED = 1;
    public const REJECTED = 2;
    public const ON_DELIVERY = 3;
    public const DELIVERED = 4;
    public const CANCELED = 5;
    
    protected $fillable = [
        'user_id',
        'product_id',
        'product_variety_id',
        'qty',  
        'address',
        'municipality_id',
        'contact',
        'payment_method_id',
        'transaction_no',
        'reference_no',
        'status',
        'remark',
    ];

    // ============================== Relationship ==========================================

    // public function cashier()
    // {
    //     return $this->belongsTo(User::class, 'cashier_id', 'id');
    // }

    public function payment_method():BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    // ============================== Accessor & Mutator ==========================================

    public function getPaymentReceiptAttribute()
    {
        return optional($this->getFirstMedia('payment_receipts'))->getUrl('card');
    }

    // ========================== Custom Methods ======================================================

    /**
    * media conversion
    */
    public function registerMediaCollections(): void
    {
        $this->addMediaConversion('card')
        ->width(450)
        ->keepOriginalImageFormat()
        ->nonQueued();
    }

    // ========================== Scope ======================================================

    public function scopePending($query)
    {
        return $query->where('status', self::PENDING);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', self::APPROVED);
    }

}