<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self low()
 * @method static self medium()
 * @method static self high()
 **/
Class TaskPriorityEnum extends Enum
{
    public static function labels(): array
    {
        return [
            'low' => 'Low',
            'medium' => 'Medium',
            'high' => 'High',
        ];
    }

    public static function values(): array
    {
        return [
            'low',
            'medium',
            'high',
        ];
    }
}
