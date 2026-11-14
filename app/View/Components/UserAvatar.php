<?php

namespace App\View\Components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserAvatar extends Component
{
    public string $shortName;

    public function __construct(String $userName)
    {
        $this->shortName = strtoupper(mb_substr($userName, 0, 2));
    }

    public function render(): View|Closure|string
    {
        return view('components.user-avatar');
    }
}
