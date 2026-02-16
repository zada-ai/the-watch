<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyVideo extends Model
{
    protected $table = 'buy_videos';

    protected $fillable = [
        'product_type',
        'product_id',
        'video_path',
    ];
}
