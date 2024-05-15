<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'supplier_id',
        'category_id',
        'brand_id',
        'name',
        'slug',
        'code',
        'description',
        'price',
        'qty',
        'is_available',
        'is_customized',
    ];


    // ==============================Relationship==================================================

    public function supplier():BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand():BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function varieties():HasMany
    {
        return $this->hasMany(ProductVariety::class);
    }


    // ============================== Accessor & Mutator ==========================================

    public function getFeaturedPhotoAttribute()
    {
        return $this->getFirstMedia('product_images')->getUrl();
    }

    public function getSmallFeaturedPhotoAttribute()
    {
        return $this->getFirstMedia('product_images')->getUrl('large');
    }

    public function getLargeFeaturedPhotoAttribute()
    {
        return $this->getFirstMedia('product_images')->getUrl('large');
    }

    public function getFirstVarietyAttribute()
    {
        return $this->varieties()->first();
    }

    public function getLastVarietyAttribute()
    {
        return $this->varieties()->latest()->first();
    }

    public function getVarietyRangeAttribute()
    {
        $min = $this->varieties()->min('price');
        $max = $this->varieties()->max('price');

        return "$min - ₱$max";
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    // ========================== Custom Methods ======================================================

    //media convertion
    public function registerMediaCollections(): void
    {
        // $this
        // ->addMediaConversion('original')
        // ->width(512)
        // ->keepOriginalImageFormat()
        // ->nonQueued();

         $this
        ->addMediaConversion('small')
        ->width(512)
        ->nonQueued();

         $this
        ->addMediaConversion('large')
        ->width(1200)
        ->nonQueued();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // ========================== Scope ======================================================

    public function scopeCustomized($query)
    {
        return $query->where('is_customized', true);
    }

    public function scopeNotCustomized($query)
    {
        return $query->where('is_customized', false);
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function scopeNotAvailable($query)
    {
        return $query->where('is_available', false);
    }

}