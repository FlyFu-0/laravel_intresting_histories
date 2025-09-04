<?php

namespace App\Policies;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TagPolicy
{
    public function before(User $user, string $ability): Response|null
    {
        if ($user->isAdmin()) {
            return Response::allow();
        }

        return null;
    }
    public function viewAny(User $user): Response
    {
        return Response::denyAsNotFound();
    }

    public function view(User $user, Tag $tag): Response
    {
        return Response::denyAsNotFound();
    }

    public function create(User $user): Response
    {
        return Response::denyAsNotFound();
    }

    public function update(User $user, Tag $tag): Response
    {
        return Response::denyAsNotFound();
    }

    public function delete(User $user, Tag $tag): Response
    {
        return Response::denyAsNotFound();
    }

    public function restore(User $user, Tag $tag): Response
    {
        return Response::denyAsNotFound();
    }

    public function forceDelete(User $user, Tag $tag): Response
    {
        return Response::denyAsNotFound();
    }
}
