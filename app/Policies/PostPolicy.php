<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
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

    public function viewMy(User $user): Response
    {
        return $user->exists
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function viewRequests(User $user): Response
    {
        return Response::denyAsNotFound();
    }

    public function view(User $user, Post $post): Response
    {
        return Response::denyAsNotFound();
    }

    public function create(User $user): Response
    {
        if ($user->isMuted()) {
            return Response::deny(__('User muted until :date_until', ['date_until' => $user->muted_until]));
        }

        return Response::allow();
    }

    public function update(User $user, Post $post): Response
    {
        return Response::denyAsNotFound();
    }

    public function delete(User $user, Post $post): Response
    {
        return Response::denyAsNotFound();
    }

    public function restore(User $user, Post $post): Response
    {
        return Response::denyAsNotFound();
    }

    public function forceDelete(User $user, Post $post): Response
    {
        return Response::denyAsNotFound();
    }
}
