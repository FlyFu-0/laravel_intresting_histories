<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function before(User $user, string $ability): Response|null
    {
        if ($user->isAdmin() && !in_array($ability, ['ban', 'mute'])) {
            return Response::allow();
        }

        return null;
    }

    public function viewAny(User $user): Response
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::denyAsNotFound();
    }


    public function view(User $user, User $model): Response
    {
        return Response::denyAsNotFound();
    }

    public function create(User $user): Response
    {
        return Response::denyAsNotFound();
    }

    public function update(User $user, User $model): Response
    {
        return Response::denyAsNotFound();
    }

    public function ban(User $user, User $model): Response
    {
        if ($user->id === $model->id) {
            return Response::deny('You can\'t ban yourself.');
        }

        return Response::allow();
    }

    public function mute(User $user, User $model): Response
    {
        return $user->id !== $model->id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function delete(User $user, User $model): Response
    {
        return Response::denyAsNotFound();
    }

    public function restore(User $user, User $model): Response
    {
        return Response::denyAsNotFound();
    }

    public function forceDelete(User $user, User $model): Response
    {
        return Response::denyAsNotFound();
    }
}
