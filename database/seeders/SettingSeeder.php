<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds with static values.
     */
    public function run(): void
    {
        $settings = [
            // Paymob Configuration
            'PAYMOB_BASE_URL' => 'https://accept.paymob.com',
            'PAYMOB_API_KEY' => 'ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SmpiR0Z6Y3lJNklrMWxjbU5vWVc1MElpd2ljSEp2Wm1sc1pWOXdheUk2TVRFeE16STRPU3dpYm1GdFpTSTZJbWx1YVhScFlXd2lmUS5NSF96bVNyVWZDTDZFeURYNjdpREstY3pxUUF0MUJoZ1d1SmFEd2xpcGstLXN1MWJ6YkZPSTVTbC15VkFNWG5GbktpZi1NQ0w1QldyYV9xZEVSM0ZRUQ==',
            'PAYMOB_INTEGRATION_ID' => '5425183',
            'PAYMOB_IFRAME_ID' => '985473',

            // Bosta Configuration
            'BOSTA_API_KEY' => 'b286cff91b7015a1ef89aea14d750f4f1e241fd3b96486a7d87a47d21ff4933f',
            'BOSTA_BASE_URL' => 'https://stg-app.bosta.co/api/v2',

            // Mail Configuration
            'MAIL_MAILER' => 'smtp',
            'MAIL_HOST' => 'smtp.gmail.com',
            'MAIL_PORT' => '465',
            'MAIL_USERNAME' => 'ahmadkholy98@gmail.com',
            'MAIL_PASSWORD' => 'akcynlcfghdfxjrq',
            'MAIL_FROM_ADDRESS' => 'ahmadkholy98@gmail.com',
            'MAIL_FROM_NAME' => 'Laravel',

            // URLs
            'FRONTEND_URL' => 'http://localhost:3000',

            // WhatsApp Configuration
            'WHATSAPP_PROVIDER' => 'auto',
            'WHATSAPP_ACCOUNT_SID' => 'ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
            'WHATSAPP_AUTH_TOKEN' => 'd8b5b33dbb7ac144dbd53864c7d6fe66',
            'WHATSAPP_PHONE_NUMBER' => '+14155238886',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => (string) $value]
            );
        }

        $this->command->info('Database settings table initialized with static values!');
    }
}
