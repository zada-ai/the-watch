<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PerfumeProduct;

class PerfumeProductSeeder extends Seeder
{
    public function run(): void
    {
        $perfumes = [
            [
                'name' => 'Luxury Fragrance Black',
                'orig_price' => 8000,
                'price' => 4500,
                'discount' => 44,
                'descri' => 'Premium quality perfume',
                'images' => ['storage/perfume/black1.jpg', 'storage/perfume/black2.jpg'],
                'colors' => ['black' => '#000000', 'gold' => '#FFD700'],
                'gender' => 'men',
                'active' => true
            ],
            [
                'name' => 'Rose Garden Perfume',
                'orig_price' => 6500,
                'price' => 3250,
                'discount' => 50,
                'descri' => 'Floral fragrance collection',
                'images' => ['storage/perfume/rose1.jpg', 'storage/perfume/rose2.jpg'],
                'colors' => ['pink' => '#FFB6C1', 'red' => '#FF0000'],
                'gender' => 'women',
                'active' => true
            ],
            [
                'name' => 'Ocean Breeze Scent',
                'orig_price' => 5500,
                'price' => 2750,
                'discount' => 50,
                'descri' => 'Fresh ocean fragrance',
                'images' => ['storage/perfume/ocean1.jpg'],
                'colors' => ['blue' => '#0066CC'],
                'gender' => null,
                'active' => true
            ],
        ];

        foreach ($perfumes as $perfume) {
            PerfumeProduct::create($perfume);
        }
    }
}
