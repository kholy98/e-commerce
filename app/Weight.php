<?php

namespace App;

enum Weight: string
{
    case GM_125 = '125gm';
    case GM_250 = '250gm';
    case GM_500 = '500gm';
    case KG_1 = '1kg';

    /**
     * Get the weight value in kg as float
     */
    public function toKg(): float
    {
        return match ($this) {
            self::GM_125 => 0.125,
            self::GM_250 => 0.250,
            self::GM_500 => 0.500,
            self::KG_1 => 1.000,
        };
    }

    /**
     * Get the display label
     */
    public function label(): string
    {
        return match ($this) {
            self::GM_125 => '125g',
            self::GM_250 => '250g',
            self::GM_500 => '500g',
            self::KG_1 => '1kg',
        };
    }

    /**
     * Get all weight options
     */
    public static function options(): array
    {
        return collect(self::cases())->map(function ($case) {
            return [
                'value' => $case->value,
                'label' => $case->label(),
                'kg' => $case->toKg(),
            ];
        })->toArray();
    }

    /**
     * Get enum case from kg value
     */
    public static function fromKg(float $kg): ?self
    {
        foreach (self::cases() as $case) {
            if (abs($case->toKg() - $kg) < 0.001) {
                return $case;
            }
        }

        return null;
    }
}
