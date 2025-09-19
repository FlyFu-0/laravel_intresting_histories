<?php

namespace App\Policies;

use App\Models\Like;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LikePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Like $like): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Like $like): bool
    {
        return false;
    }

    public function delete(User $user, Like $like): bool
    {
        return true;
    }

    public function restore(User $user, Like $like): bool
    {
        return false;
    }

    public function forceDelete(User $user, Like $like): bool
    {
        return false;
    }
}
