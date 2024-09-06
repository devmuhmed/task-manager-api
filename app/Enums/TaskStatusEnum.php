<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self pending()
 * @method static self in_progress()
 * @method static self completed()
 **/
Class TaskStatusEnum extends Enum
{
    public static function labels(): array
    {
        return [
            'pending' => 'Pending',
            'in_progress' => 'In Progress',
            'completed' => 'Completed',
        ];
    }

    public static function values(): array
    {
        return [
            'pending',
            'in_progress',
            'completed',
        ];
    }
}
