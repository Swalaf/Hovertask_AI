<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create a seller user
        $seller = User::firstOrCreate(
            ['email' => 'seller@hovertask.com'],
            [
                'fname' => 'Test',
                'lname' => 'Seller',
                'username' => 'testseller',
                'phone' => '2348098765432',
                'password' => bcrypt('password123'),
                'email_verified_at' => now(),
            ]
        );

        $products = [
            [
                'name' => 'iPhone 14 Pro Max',
                'description' => 'Latest Apple iPhone with advanced camera system, A16 chip, and Dynamic Island. 256GB storage in Deep Purple color.',
                'price' => 850000,
                'category' => 'Electronics',
                'stock' => 10,
                'status' => 'active',
            ],
            [
                'name' => 'Samsung Galaxy S23 Ultra',
                'description' => 'Premium Android smartphone with 200MP camera, S Pen, and 512GB storage. Elegant Phantom Black finish.',
                'price' => 720000,
                'category' => 'Electronics',
                'stock' => 15,
                'status' => 'active',
            ],
            [
                'name' => 'MacBook Air M2',
                'description' => 'Super lightweight laptop with M2 chip, 13.6-inch display, and all-day battery life. Space Gray color.',
                'price' => 680000,
                'category' => 'Electronics',
                'stock' => 8,
                'status' => 'active',
            ],
            [
                'name' => 'Nike Air Max 270',
                'description' => 'Classic running shoes with Air Max cushioning and modern design. Available in multiple colors.',
                'price' => 45000,
                'category' => 'Fashion',
                'stock' => 25,
                'status' => 'active',
            ],
            [
                'name' => 'Adidas Ultraboost 22',
                'description' => 'Premium running shoes with Boost midsole technology for incredible energy return.',
                'price' => 55000,
                'category' => 'Fashion',
                'stock' => 20,
                'status' => 'active',
            ],
            [
                'name' => 'Sony WH-1000XM5 Headphones',
                'description' => 'Industry-leading noise cancellation with exceptional sound quality. 30-hour battery life.',
                'price' => 125000,
                'category' => 'Electronics',
                'stock' => 12,
                'status' => 'active',
            ],
            [
                'name' => 'Dyson V15 Detect Vacuum',
                'description' => 'Powerful cordless vacuum with laser dust detection and automatic floor sensor.',
                'price' => 280000,
                'category' => 'Home & Garden',
                'stock' => 5,
                'status' => 'active',
            ],
            [
                'name' => 'Canon EOS R6 Camera',
                'description' => 'Full-frame mirrorless camera with 20.1MP sensor, 4K video, and in-body stabilization.',
                'price' => 450000,
                'category' => 'Electronics',
                'stock' => 3,
                'status' => 'active',
            ],
            [
                'name' => 'Apple Watch Series 8',
                'description' => 'Advanced health monitoring, always-on display, and cellular connectivity. 45mm case.',
                'price' => 185000,
                'category' => 'Electronics',
                'stock' => 18,
                'status' => 'active',
            ],
            [
                'name' => 'Gaming Chair Ergonomic',
                'description' => 'Premium gaming chair with lumbar support, adjustable armrests, and recline function.',
                'price' => 75000,
                'category' => 'Home & Garden',
                'stock' => 14,
                'status' => 'active',
            ],
            [
                'name' => 'PS5 Console',
                'description' => 'Next-gen gaming console with 825GB SSD, 4K gaming, and Ray Tracing support.',
                'price' => 320000,
                'category' => 'Electronics',
                'stock' => 6,
                'status' => 'active',
            ],
            [
                'name' => 'Designer Handbag - LV Neverfull',
                'description' => 'Luxury designer handbag in monogram canvas with leather trim. Spacious and elegant.',
                'price' => 150000,
                'category' => 'Fashion',
                'stock' => 4,
                'status' => 'active',
            ],
        ];

        foreach ($products as $productData) {
            Product::create([
                'user_id' => $seller->id,
                'name' => $productData['name'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'category' => $productData['category'],
                'stock' => $productData['stock'],
                'status' => $productData['status'],
            ]);
        }

        $this->command->info('Products seeded successfully!');
        $this->command->info('Created '.count($products).' products for seller: '.$seller->email);
    }
}
