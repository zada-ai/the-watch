<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Watches
        Product::create([
            'name' => 'Premium Chrono X1',
            'category' => 'watches',
            'price' => 12999,
            'original_price' => 18999,
            'description' => 'Premium build, water resistant, 2-year warranty',
            'images' => [
                asset('Landingpaginationimg/desktop_9.jfif'),
                asset('Landingpaginationimg/desktop_4.jfif'),
                asset('Landingpaginationimg/desktop_7.jfif'),
            ],
            'colors' => ['#111827', '#b45309', '#0369a1'],
            'discount' => 31,
            'active' => true
        ]);

        Product::create([
            'name' => 'Luxury Timepiece Pro',
            'category' => 'watches',
            'price' => 15999,
            'original_price' => 22999,
            'description' => 'Premium luxury watch with sapphire crystal',
            'images' => [
                asset('Landingpaginationimg/desktop_4.jfif'),
                asset('Landingpaginationimg/desktop_9.jfif'),
                asset('Landingpaginationimg/desktop_7.jfif'),
            ],
            'colors' => ['#0f172a', '#7c3aed', '#ef4444'],
            'discount' => 30,
            'active' => true
        ]);

        Product::create([
            'name' => 'Classic Elite Watch',
            'category' => 'watches',
            'price' => 9999,
            'original_price' => 14999,
            'description' => 'Classic design with modern features',
            'images' => [
                asset('Landingpaginationimg/desktop_7.jfif'),
                asset('Landingpaginationimg/year-end-banner.jfif'),
                asset('Landingpaginationimg/desktop_9.jfif'),
            ],
            'colors' => ['#0b1220', '#059669', '#d97706'],
            'discount' => 33,
            'active' => true
        ]);

        // Headphones
        Product::create([
            'name' => 'Elite Headset Pro',
            'category' => 'headphones',
            'price' => 7999,
            'original_price' => 11999,
            'description' => 'High-quality sound, noise cancellation, comfort fit',
            'images' => [
                asset('Landingpaginationimg/desktop_4.jfif'),
                asset('Landingpaginationimg/desktop_9.jfif'),
                asset('Landingpaginationimg/desktop_7.jfif'),
            ],
            'colors' => ['#0f172a', '#7c3aed', '#ef4444'],
            'discount' => 33,
            'active' => true
        ]);

        Product::create([
            'name' => 'Studio Sound Master',
            'category' => 'headphones',
            'price' => 8999,
            'original_price' => 13499,
            'description' => 'Studio-grade audio for professionals',
            'images' => [
                asset('Landingpaginationimg/desktop_7.jfif'),
                asset('Landingpaginationimg/desktop_4.jfif'),
                asset('Landingpaginationimg/desktop_9.jfif'),
            ],
            'colors' => ['#1e40af', '#dc2626', '#7c3aed'],
            'discount' => 33,
            'active' => true
        ]);

        Product::create([
            'name' => 'Bass Boost Extreme',
            'category' => 'headphones',
            'price' => 6999,
            'original_price' => 10499,
            'description' => 'Deep bass, immersive audio experience',
            'images' => [
                asset('Landingpaginationimg/desktop_9.jfif'),
                asset('Landingpaginationimg/desktop_7.jfif'),
                asset('Landingpaginationimg/desktop_4.jfif'),
            ],
            'colors' => ['#111827', '#0369a1', '#059669'],
            'discount' => 33,
            'active' => true
        ]);

        // Airbuds
        Product::create([
            'name' => 'Airbuds Supreme',
            'category' => 'airbuds',
            'price' => 4999,
            'original_price' => 7499,
            'description' => 'Wireless, long battery, premium sound quality',
            'images' => [
                asset('Landingpaginationimg/desktop_7.jfif'),
                asset('Landingpaginationimg/year-end-banner.jfif'),
                asset('Landingpaginationimg/Aura.jpg'),
            ],
            'colors' => ['#0b1220', '#059669', '#d97706'],
            'discount' => 33,
            'active' => true
        ]);

        Product::create([
            'name' => 'Wireless Pro Buds',
            'category' => 'airbuds',
            'price' => 5999,
            'original_price' => 8999,
            'description' => 'Advanced wireless connectivity, noise cancellation',
            'images' => [
                asset('Landingpaginationimg/desktop_9.jfif'),
                asset('Landingpaginationimg/desktop_4.jfif'),
                asset('Landingpaginationimg/desktop_7.jfif'),
            ],
            'colors' => ['#111827', '#b45309', '#1e40af'],
            'discount' => 33,
            'active' => true
        ]);

        Product::create([
            'name' => 'Ultra Sync Earbuds',
            'category' => 'airbuds',
            'price' => 3999,
            'original_price' => 5999,
            'description' => 'Budget-friendly premium quality earbuds',
            'images' => [
                asset('Landingpaginationimg/desktop_4.jfif'),
                asset('Landingpaginationimg/desktop_7.jfif'),
                asset('Landingpaginationimg/desktop_9.jfif'),
            ],
            'colors' => ['#dc2626', '#7c3aed', '#059669'],
            'discount' => 33,
            'active' => true
        ]);
    }
}
