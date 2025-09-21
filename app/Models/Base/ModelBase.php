<?php

namespace  App\Models\Base;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

abstract class ModelBase extends Model
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
