<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BestSeller extends Model
{
    use HasFactory;

    protected $table = 'best_sellers';

    protected $fillable = [
        'name', 'descri', 'orig_price', 'sale_price', 'discount',
        'colors', 'images', 'category', 'active'
    ];

    protected $casts = [
        'colors' => 'array',
        'images' => 'array',
        'active' => 'boolean',
    ];
}
