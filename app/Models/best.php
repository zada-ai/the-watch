<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Best extends Model
{
    protected $table = 'best';

    protected $fillable = [
        'name','category','original_price','sale_price',
        'discount','rating','reviews','image','status'
    ];
}

