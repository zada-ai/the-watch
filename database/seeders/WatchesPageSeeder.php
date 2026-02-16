<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WatchesPage;

class WatchesPageSeeder extends Seeder
{
    public function run(): void
    {
        WatchesPage::create([
            'name' => 'Luxury Watch Black',
            'orig_price' => 15000,
            'sale_price' => 7500,
            'discount' => 50,
            'descri' => 'Premium quality watch',
            'images' => [
                'black' => [
                    'storage/watches/black1.jpg',
                    'storage/watches/black2.jpg'
                ],
                'silver' => [
                    'storage/watches/silver1.jpg'
                ]
            ],
            'colors' => [
                'black' => '#000000',
                'silver' => '#c0c0c0'
            ],
            'gender' => 'men',
            'active' => true
        ]);
    }
}

