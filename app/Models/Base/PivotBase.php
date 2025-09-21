<?php

namespace  App\Models\Base;

use \Illuminate\Database\Eloquent\Relations\Pivot;
use Carbon\Carbon;

abstract class PivotBase extends Pivot
{
    protected function getDatetimeFormat(Carbon $date): string
    {
        $dateFormat = 'd F';
        $timeFormat = 'H:i';

        if ($date->year !== Carbon::now()->year) {
            $dateFormat .= ' Y';
        }

        return $dateFormat . ' ' . $timeFormat;
    }
}
