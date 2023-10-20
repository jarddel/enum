<?php

namespace Robusto\Enum\Tests;

use Robusto\Enum\Enum;

class DayWeekEnum extends Enum
{
    const SUNDAY    = 1,
          MONDAY    = 2,
          TUESDAY   = 3,
          WEDNESDAY = 4,
          THURSDAY  = 5,
          FRIDAY    = 6,
          SATURDAY  = 7
    ;

    protected static $descriptions = [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday'
    ];
}
