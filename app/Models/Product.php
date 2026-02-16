<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category',
        'price',
        'original_price',
        'description',
        'images',
        'colors',
        'discount',
        'active'
    ];

    protected $casts = [
        'images' => 'array',
        'colors' => 'array',
        'active' => 'boolean'
    ];}