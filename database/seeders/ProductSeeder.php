<?php

namespace Database\Seeders;

use App\GrindType;
use App\Models\Category;
use App\Models\Product;
use App\Weight;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            return;
        }

        $espressoCategory = $categories->where('slug', 'espresso')->first();
        $coffeeCategories = $categories->whereIn('slug', ['plain-coffee', 'roast-coffee']);

        $espressoBasePrices = [
            'dark' => 400,
        ];

        $coffeeBasePrices = [
            'plain-coffee' => [
                'light' => 250,
                'medium' => 275,
                'dark' => 300,
            ],
            'roast-coffee' => [
                'light' => 300,
                'medium' => 325,
                'dark' => 350,
            ],
        ];

        $descriptions = [
            'plain-coffee' => [
                'en' => 'Classic plain coffee beans for a pure and traditional taste',
                'ar' => 'حبوب قهوة كلاسيكية بنكهة نقية وتقليدية',
            ],
            'roast-coffee' => [
                'en' => 'Rich and aromatic roasted coffee beans with a deep flavor',
                'ar' => 'حبوب قهوة محمصة غنية وعطرية بنكهة عميقة',
            ],
            'espresso' => [
                'en' => 'Premium beans optimized for espresso extraction',
                'ar' => 'حبوب مختارة خصيصاً لتحضير الإسبريسو',
            ],
        ];

        if ($espressoCategory) {
            $grindType = GrindType::DARK;
            foreach (Weight::cases() as $weight) {
                $weightKg = $weight->toKg();
                $weightLabel = $weight->label();

                $price = round($espressoBasePrices[$grindType->value] * $weightKg, 2);
                $cost = round($price * 0.4, 2);

                $sku = 'ESP-DK-'.strtoupper(str_replace(['.', 'kg', 'g'], ['', '', ''], $weight->value));

                Product::firstOrCreate(
                    [
                        'sku' => $sku,
                    ],
                    [
                        'name' => 'Espresso '.$weightLabel,
                        'name_ar' => 'إسبريسو '.$weightLabel,
                        'description' => $descriptions['espresso']['en'].' Dark roast for a perfect espresso shot.',
                        'description_ar' => $descriptions['espresso']['ar'].'. تحميص غامق لإسبريسو مثالي.',
                        'price' => $price,
                        'cost' => $cost,
                        'stock' => 100,
                        'category_id' => $espressoCategory->id,
                        'is_active' => true,
                        'grind_type' => $grindType->value,
                        'weight' => $weightKg,
                    ]
                );
            }
        }

        foreach ($coffeeCategories as $category) {
            $categorySlug = $category->slug;
            $categoryPrices = $coffeeBasePrices[$categorySlug] ?? $coffeeBasePrices['plain-coffee'];
            $categoryDescriptions = $descriptions[$categorySlug] ?? $descriptions['plain-coffee'];

            foreach (GrindType::cases() as $grindType) {
                foreach (Weight::cases() as $weight) {
                    $weightKg = $weight->toKg();
                    $grindLabel = $grindType->label();
                    $grindLabelAr = $grindType->labelAr();
                    $weightLabel = $weight->label();

                    $price = round($categoryPrices[$grindType->value] * $weightKg, 2);
                    $cost = round($price * 0.4, 2);

                    $sku = 'COF-'.strtoupper(substr($categorySlug, 0, 3)).'-'.strtoupper(substr($grindType->value, 0, 2)).'-'.strtoupper(str_replace(['.', 'kg', 'g'], ['', '', ''], $weight->value));

                    Product::firstOrCreate(
                        [
                            'sku' => $sku,
                        ],
                        [
                            'name' => $category->name.' '.$grindLabel.' '.$weightLabel,
                            'name_ar' => $category->name_ar.' '.$grindLabelAr.' '.$weightLabel,
                            'description' => $categoryDescriptions['en'].'. '.$grindLabel.' roast for a perfect cup.',
                            'description_ar' => $categoryDescriptions['ar'].'. تحميص '.$grindLabelAr.' لتناول فنجان مثالي.',
                            'price' => $price,
                            'cost' => $cost,
                            'stock' => 100,
                            'category_id' => $category->id,
                            'is_active' => true,
                            'grind_type' => $grindType->value,
                            'weight' => $weightKg,
                        ]
                    );
                }
            }
        }
    }
}
