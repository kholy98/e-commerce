<?php

namespace App;

enum GrindType: string
{
    case WHOLE_BEAN = 'whole_bean';
    case COARSE = 'coarse';
    case MEDIUM = 'medium';
    case FINE = 'fine';
    case EXTRA_FINE = 'extra_fine';

    /**
     * Get the English label for the grind type
     */
    public function label(): string
    {
        return match ($this) {
            self::WHOLE_BEAN => 'Whole Bean',
            self::COARSE => 'Coarse',
            self::MEDIUM => 'Medium',
            self::FINE => 'Fine',
            self::EXTRA_FINE => 'Extra Fine',
        };
    }

    /**
     * Get the Arabic label for the grind type
     */
    public function labelAr(): string
    {
        return match ($this) {
            self::WHOLE_BEAN => 'حبة كاملة',
            self::COARSE => 'خشن',
            self::MEDIUM => 'متوسط',
            self::FINE => 'ناعم',
            self::EXTRA_FINE => 'ناعم جداً',
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
