<?php

namespace App\Http\Controllers;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

abstract class Controller extends \Illuminate\Routing\Controller
{
    const PAGE_SIZE = 2;

    protected function paginate($query, int $pageSize = 0)
    {
        return $query->paginate($pageSize ?: static::PAGE_SIZE);
    }
}
