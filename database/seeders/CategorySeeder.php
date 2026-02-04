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
                'name' => 'Plain Coffee',
                'name_ar' => 'بن سادة',
                'description' => 'Classic plain coffee beans for those who enjoy the pure, traditional taste without any additions',
                'description_ar' => 'حبوب القهوة الكلاسيكية الخفيفة لمن يحبون الطعم النقي والتقليدي بدون أي إضافات',
                'is_active' => true,
            ],
            [
                'name' => 'Roast Coffee',
                'name_ar' => 'بن محوج',
                'description' => 'Rich and aromatic roasted coffee beans with a deep, full-bodied flavor profile',
                'description_ar' => 'حبوب القهوة المحمصة الغنية والعطرية بنكهة قوية وكاملة الجسم',
                'is_active' => true,
            ],
            [
                'name' => 'Espresso',
                'name_ar' => 'إسبريسو',
                'description' => 'Specially selected beans optimized for espresso extraction with intense flavor and crema',
                'description_ar' => 'حبوب مختارة خصيصاً لتحضير الإسبريسو بنكهة مكثفة وقشدة غنية',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate($category);
        }
    }
}
