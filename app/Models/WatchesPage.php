<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WatchesPage extends Model
{
    protected $table = 'watchespage';

    protected $fillable = [
        'name',
        'category',
        'active',
        'orig_price',
        'sale_price',
        'discount',
        'descri',
        'images',
        'colors',
        'gender',
    ];

    protected $casts = [
        'images' => 'array',
        'colors' => 'array',
        'active' => 'boolean',
    ];
}
