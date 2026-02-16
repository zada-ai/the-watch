<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfumeProduct extends Model
{
    use HasFactory;

    protected $table = 'perfume_products';

    protected $fillable = [
        'name',
        'category',
        'price',
        'orig_price',
        'descri',
        'images',
        'colors',
        'discount',
        'gender',
        'active',
    ];

    protected $casts = [
        'images' => 'array',
        'colors' => 'array',
        'active' => 'boolean',
    ];
}
