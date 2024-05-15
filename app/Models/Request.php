<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory, BelongsToUser;

    protected $fillable = [
        'user_id', 
        'service_id',
        'company',
        'message', 
        'target_date',
        'file_link',
        'is_reviewed',
    ];

    // ==============================Relationship==================================================

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // ========================== Scope ======================================================

    public function scopePending($query)
    {
        return $query->where('is_reviewed', false);
    }


}