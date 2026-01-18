<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $fillable = [
        'phones',
        'emails',
        'addresses_en',
        'addresses_ar',
        'working_hours_en',
        'working_hours_ar',
    ];

    protected $casts = [
        'phones' => 'array',
        'emails' => 'array',
        'addresses_en' => 'array',
        'addresses_ar' => 'array',
        'working_hours_en' => 'array',
        'working_hours_ar' => 'array',
    ];
}
