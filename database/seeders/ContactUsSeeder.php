<?php

namespace Database\Seeders;

use App\Models\ContactUs;
use Illuminate\Database\Seeder;

class ContactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactUs::create([
            'phones' => ['+1234567890', '+0987654321'],
            'emails' => ['info@example.com', 'support@example.com'],
            'addresses_en' => ['123 Main St, City, Country'],
            'addresses_ar' => ['123 شارع الرئيسي، المدينة، البلد'],
            'working_hours_en' => ['Mon-Fri: 9AM-6PM', 'Sat: 10AM-4PM'],
            'working_hours_ar' => ['الاثنين-الجمعة: 9ص-6م', 'السبت: 10ص-4م'],
        ]);
    }
}
