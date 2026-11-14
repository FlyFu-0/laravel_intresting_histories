<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends \Illuminate\Routing\Controller
{
    use AuthorizesRequests;

    const PAGE_SIZE = 2;

    protected function paginate($query, int $pageSize = 0)
    {
        return $query->paginate($pageSize ?: static::PAGE_SIZE);
    }
}
