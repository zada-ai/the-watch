<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ToysProduct;

class ToysProductSeeder extends Seeder
{
    public function run(): void
    {
        $toys = [
            [
                'name' => 'Smart Robot Toy',
                'orig_price' => 4500,
                'price' => 2250,
                'discount' => 50,
                'descri' => 'Interactive smart robot',
                'images' => ['storage/toys/robot1.jpg', 'storage/toys/robot2.jpg'],
                'colors' => ['red' => '#FF0000', 'blue' => '#0066CC'],
                'gender' => null,
                'active' => true
            ],
            [
                'name' => 'Action Figure Set',
                'orig_price' => 3000,
                'price' => 1500,
                'discount' => 50,
                'descri' => 'Premium action figures',
                'images' => ['storage/toys/figure1.jpg', 'storage/toys/figure2.jpg'],
                'colors' => ['black' => '#000000', 'gold' => '#FFD700'],
                'gender' => null,
                'active' => true
            ],
            [
                'name' => 'Educational Building Blocks',
                'orig_price' => 2500,
                'price' => 1250,
                'discount' => 50,
                'descri' => 'Learning building blocks',
                'images' => ['storage/toys/blocks1.jpg'],
                'colors' => ['yellow' => '#FFFF00'],
                'gender' => null,
                'active' => true
            ],
        ];

        foreach ($toys as $toy) {
            ToysProduct::create($toy);
        }
    }
}
