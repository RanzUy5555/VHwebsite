<?php

namespace App\Models;

use App\Traits\HasManyProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory, HasManyProduct;

    protected $fillable = ['name', 'fee'];

}