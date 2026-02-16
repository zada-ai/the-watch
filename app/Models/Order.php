<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_type','product_id','product_name','unit_price','quantity','total_price','orig_price',
        'selected_colors','selected_color_qtys','payment_method','payment_sub','payment_txn_id','payment_proof_path',
        'ship_name','ship_address','ship_city','ship_nearby','ship_postal','ship_country','buyer_email','buyer_phone'
    ];

    protected $casts = [
        'selected_colors' => 'array',
        'selected_color_qtys' => 'array',
    ];
}
