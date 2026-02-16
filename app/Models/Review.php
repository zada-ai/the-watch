<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['name', 'rating', 'review', 'product_name', 'product_type', 'product_id', 'image'];
    
    protected $casts = [
        'rating' => 'integer',
    ];
}
