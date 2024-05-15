<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Service extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name', 
        'description', 
    ];


    // ==============================Relationship==================================================

    public function requests():HasMany
    {
        return $this->hasMany(Request::class);
    }

     // ============================== Accessor & Mutator ==========================================

    public function getFeaturedPhotoAttribute()
    {
        return $this->getFirstMedia('service_images')->getUrl('card');
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
 
     // ========================== Custom Methods ======================================================
 
     //media convertion
     public function registerMediaCollections(): void
     {
         $this
         ->addMediaConversion('card')
         ->width(600)
         ->keepOriginalImageFormat()
         ->nonQueued();
     }

}   