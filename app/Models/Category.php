<?php

namespace App\Models;

use App\Traits\HasManyProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, HasManyProduct;

    protected $fillable = ['name'];
}