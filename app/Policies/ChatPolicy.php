<?php

namespace App\Policies;

use App\Models\Chat;
use App\Models\User;

class ChatPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Chat $chat): bool
    {
        return $chat->users()->where('users.id', $user->id)->exists();
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function message(User $user, Chat $chat): bool
    {
        return $this->view($user, $chat);
    }

    public function update(User $user, Chat $chat): bool
    {
        return $this->view($user, $chat);
    }

    public function delete(User $user, Chat $chat): bool
    {
        return $this->view($user, $chat);
    }
}
