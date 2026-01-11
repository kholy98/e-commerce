<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Bosta Shipping Pricing Configuration
    |--------------------------------------------------------------------------
    |
    | Pricing matrix for Bosta shipping services in Egypt (EGP, before VAT)
    | Based on: https://bosta.co/en-eg/pricing
    | All prices are in Egyptian Pounds (EGP)
    |
    */

    'pricing' => [
        'cairo' => [
            'small_medium' => 80,
            'light_bulky' => 180,
            'heavy_bulky' => 430,
        ],
        'alex' => [
            'small_medium' => 85,
            'light_bulky' => 185,
            'heavy_bulky' => 480,
        ],
        'delta_canal' => [
            'small_medium' => 91,
            'light_bulky' => 191,
            'heavy_bulky' => 540,
        ],
        'upper_redsea' => [
            'small_medium' => 116,
            'light_bulky' => 216,
            'heavy_bulky' => 790,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Delivery Zones Mapping
    |--------------------------------------------------------------------------
    |
    | Maps cities/regions to Bosta pricing zones
    |
    */

    'zones' => [
        'cairo' => [
            'cairo', 'giza', '6th of october', 'nasr city', 'heliopolis',
            'maadi', 'zamalek', 'downtown cairo', 'shubra', 'ain shams'
        ],
        'alex' => [
            'alexandria', 'alex', 'borg el arab', 'abu qir', 'sidi gaber'
        ],
        'delta_canal' => [
            'damietta', 'port said', 'suez', 'ismailia', 'mansoura',
            'tanta', 'zagazig', 'banha', 'kafr el-sheikh', 'damanhur'
        ],
        'upper_redsea' => [
            'luxor', 'aswan', 'hurghada', 'sharm el sheikh', 'dahab',
            'marsa alam', 'safaga', 'el gouna', 'qena', 'sohag',
            'assiut', 'minya', 'beni suef', 'fayoum'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Package Size Determination
    |--------------------------------------------------------------------------
    |
    | Rules for determining package size category
    |
    */

    'package_sizes' => [
        'small_medium' => [
            'max_weight' => 5, // kg
            'max_dimension' => 50, // cm (any single dimension)
            'description' => 'Standard delivery for small to medium packages'
        ],
        'light_bulky' => [
            'max_weight' => 20, // kg
            'max_dimension' => 100, // cm (any single dimension)
            'description' => 'Light bulky items requiring special handling'
        ],
        'heavy_bulky' => [
            'min_weight' => 20, // kg
            'min_dimension' => 100, // cm (any single dimension)
            'description' => 'Heavy bulky items with special delivery requirements'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Settings
    |--------------------------------------------------------------------------
    */

    'defaults' => [
        'zone' => 'cairo', // Default zone if city not found
        'size' => 'small_medium', // Default package size
        'free_shipping_threshold' => 5000, // Orders over this amount get free shipping (EGP)
        'vat_rate' => 0.14, // 14% VAT in Egypt
        'include_vat' => false, // Whether to include VAT in shipping cost
    ],
];