<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class BuyImage extends Model
{
    protected $fillable = [
        'product_type',
        'product_id',
        'image_path'
    ];
}
