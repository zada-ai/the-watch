<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WalletsProduct;

class WalletsProductSeeder extends Seeder
{
    public function run(): void
    {
        $wallets = [
            [
                'name' => 'Premium Leather Wallet Black',
                'orig_price' => 3500,
                'price' => 1750,
                'discount' => 50,
                'descri' => 'High quality leather wallet',
                'images' => ['storage/wallets/black1.jpg', 'storage/wallets/black2.jpg'],
                'colors' => ['black' => '#000000', 'brown' => '#8B4513'],
                'gender' => 'men',
                'active' => true
            ],
            [
                'name' => 'Elegant Women Wallet',
                'orig_price' => 2800,
                'price' => 1400,
                'discount' => 50,
                'descri' => 'Stylish women wallet',
                'images' => ['storage/wallets/pink1.jpg', 'storage/wallets/pink2.jpg'],
                'colors' => ['pink' => '#FFB6C1', 'red' => '#FF0000'],
                'gender' => 'women',
                'active' => true
            ],
            [
                'name' => 'Compact Travel Wallet',
                'orig_price' => 2000,
                'price' => 1000,
                'discount' => 50,
                'descri' => 'Compact design wallet',
                'images' => ['storage/wallets/blue1.jpg'],
                'colors' => ['blue' => '#0066CC'],
                'gender' => null,
                'active' => true
            ],
        ];

        foreach ($wallets as $wallet) {
            WalletsProduct::create($wallet);
        }
    }
}
