<?php

namespace App;

enum GrindType: string
{
    case LIGHT = 'light';
    case MEDIUM = 'medium';
    case DARK = 'dark';

    /**
     * Get the English label for the grind type
     */
    public function label(): string
    {
        return match ($this) {
            self::LIGHT => 'Light',
            self::MEDIUM => 'Medium',
            self::DARK => 'Dark',
        };
    }

    /**
     * Get the Arabic label for the grind type
     */
    public function labelAr(): string
    {
        return match ($this) {
            self::LIGHT => 'فاتح',
            self::MEDIUM => 'وسط',
            self::DARK => 'غامق',
        };
    }

    /**
     * Get all grind types with labels
     */
    public static function options(): array
    {
        return collect(self::cases())->map(function ($case) {
            return [
                'value' => $case->value,
                'label' => $case->label(),
                'label_ar' => $case->labelAr(),
            ];
        })->toArray();
    }
}
