<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Electronic gadgets and devices',
                'is_active' => true,
            ],
            [
                'name' => 'Clothing',
                'description' => 'Apparel and fashion items',
                'is_active' => true,
            ],
            [
                'name' => 'Books',
                'description' => 'Books and educational materials',
                'is_active' => true,
            ],
            [
                'name' => 'Home & Garden',
                'description' => 'Home and garden products',
                'is_active' => true,
            ],
            [
                'name' => 'Sports',
                'description' => 'Sports and fitness equipment',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
