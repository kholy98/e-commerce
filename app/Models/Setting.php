<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * * @var string
     */
    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * Optional: Casting
     * This ensures that even if a value is stored as a number in the DB,
     * it comes out as a string to maintain consistency with env() behavior.
     */
    protected $casts = [
        'key' => 'string',
        'value' => 'string',
    ];

    /**
     * Helper Method: Get a setting value by key quickly.
     * Usage: Setting::get('PAYMOB_API_KEY', 'default_value');
     */
    public static function get(string $key, $default = null)
    {
        $setting = self::where('key', $key)->first();

        return $setting ? $setting->value : $default;
    }
}
