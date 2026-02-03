<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Weight;
use App\GrindType;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $coffeeCategory = Category::firstOrCreate(
            ['slug' => 'coffee'],
            ['name' => 'Coffee', 'slug' => 'coffee', 'is_active' => true]
        );

        $products = [
            'Light Coffee' => [
                'description' => 'Light roast coffee with delicate flavor notes and mild acidity',
                'description_ar' => 'قهوة التحميص الخفيف مع نكهات رقيقة وحموضة معتدلة',
                'prices' => [
                    '125gm' => 8.00,
                    '250gm' => 14.00,
                    '500gm' => 26.00,
                    '1kg' => 48.00,
                ],
            ],
            'Medium Coffee' => [
                'description' => 'Medium roast coffee with balanced flavor and smooth finish',
                'description_ar' => 'قهوة التحميص المتوسط مع نكهات متوازنة ونهاية ناعمة',
                'prices' => [
                    '125gm' => 9.00,
                    '250gm' => 16.00,
                    '500gm' => 29.00,
                    '1kg' => 54.00,
                ],
            ],
            'Dark Coffee' => [
                'description' => 'Dark roast coffee with bold, rich flavor and low acidity',
                'description_ar' => 'ق

هوة التحميص الداكن مع نكهات جريئة وغنية وحموضة منخفضة',
                'prices' => [
                    '125gm' => 10.00,
                    '250gm' => 18.00,
                    '500gm' => 32.00,
                    '1kg' => 60.00,
                ],
            ],
            'Espresso' => [
                'description' => 'Premium espresso blend with intense flavor and perfect crema',
                'description_ar' => 'مزيج إسبريسو متميز بنكهة مكثفة وكريما مثالية',
                'prices' => [
                    '125gm' => 11.00,
                    '250gm' => 20.00,
                    '500gm' => 36.00,
                    '1kg' => 68.00,
                ],
            ],
        ];

        foreach ($products as $productName => $productData) {
            foreach (Weight::cases() as $weight) {
                $weightLabel = $weight->value;
                $price = $productData['prices'][$weightLabel] ?? 0;

                $sku = 'COF-' . strtoupper(substr(str_replace(' ', '', $productName), 0, 3)) . '-' . strtoupper($weight->value);

                Product::firstOrCreate([
                    'name' => $productName . ' ' . $weightLabel,
                    'name_ar' => $productName . ' ' . $weightLabel,
                    'description' => $productData['description'],
                    'description_ar' => $productData['description_ar'],
                    'price' => $price,
                    'cost' => round($price * 0.4, 2),
                    'stock' => 200,
                    'sku' => $sku,
                    'category_id' => $coffeeCategory->id,
                    'is_active' => true,
                    'grind_type' => GrindType::EXTRA_FINE->value,
                    'weight' => $weight->toKg(),
                ]);
            }
        }
    }
}
