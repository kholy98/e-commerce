<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Wireless Headphones',
                'description' => 'High-quality wireless headphones with noise cancellation',
                'price' => 129.99,
                'cost' => 50.00,
                'stock' => 50,
                'sku' => 'WH-001',
                'category_id' => Category::where('name', 'Electronics')->first()->id,
                'is_active' => true,
            ],
            [
                'name' => 'Smartwatch',
                'description' => 'Advanced smartwatch with fitness tracking',
                'price' => 199.99,
                'cost' => 80.00,
                'stock' => 30,
                'sku' => 'SW-001',
                'category_id' => Category::where('name', 'Electronics')->first()->id,
                'is_active' => true,
            ],
            [
                'name' => 'Cotton T-Shirt',
                'description' => 'Comfortable 100% cotton t-shirt',
                'price' => 29.99,
                'cost' => 10.00,
                'stock' => 200,
                'sku' => 'TS-001',
                'category_id' => Category::where('name', 'Clothing')->first()->id,
                'is_active' => true,
            ],
            [
                'name' => 'Denim Jeans',
                'description' => 'Classic blue denim jeans',
                'price' => 59.99,
                'cost' => 20.00,
                'stock' => 100,
                'sku' => 'DJ-001',
                'category_id' => Category::where('name', 'Clothing')->first()->id,
                'is_active' => true,
            ],
            [
                'name' => 'Programming Book',
                'description' => 'Learn Laravel and PHP development',
                'price' => 39.99,
                'cost' => 15.00,
                'stock' => 80,
                'sku' => 'BK-001',
                'category_id' => Category::where('name', 'Books')->first()->id,
                'is_active' => true,
            ],
            [
                'name' => 'Yoga Mat',
                'description' => 'Premium non-slip yoga mat',
                'price' => 49.99,
                'cost' => 20.00,
                'stock' => 40,
                'sku' => 'YM-001',
                'category_id' => Category::where('name', 'Sports')->first()->id,
                'is_active' => true,
            ],
            [
                'name' => 'Plant Pot',
                'description' => 'Ceramic decorative plant pot',
                'price' => 24.99,
                'cost' => 8.00,
                'stock' => 120,
                'sku' => 'PP-001',
                'category_id' => Category::where('name', 'Home & Garden')->first()->id,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
