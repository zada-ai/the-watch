<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BestSeller;

class BestSellerSeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['watches', 'headphones', 'airbuds'];

        for ($i = 1; $i <= 4; $i++) {
            foreach ($categories as $category) {
                BestSeller::create([
                    'name' => "Best Seller " . ucfirst($category) . " $i",
                    'descri' => "Premium $category $i",
                    'orig_price' => rand(5000, 18000),
                    'sale_price' => rand(2000, 15000),
                    'discount' => rand(20, 50),
                    'category' => $category,
                    'colors' => [
                        'red' => '#ff0000',
                        'blue' => '#0000ff'
                    ],
                    'images' => [
                        'red' => [
                            'img/red1.png',
                            'img/red2.png',
                            'img/red3.png',
                        ],
                        'blue' => [
                            'img/blue1.png',
                            'img/blue2.png',
                        ],
                    ],
                    'active' => true,
                ]);
            }
        }
    }
}
