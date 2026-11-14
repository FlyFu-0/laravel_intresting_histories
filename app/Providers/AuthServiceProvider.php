<?php

namespace App\Providers;

use App\Models\{
    Chat,
    Post,
    Tag,
    User,
};
use App\Policies\{
    ChatPolicy,
    PostPolicy,
    TagPolicy,
    UserPolicy,
};
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Chat::class => ChatPolicy::class,
        Post::class => PostPolicy::class,
        Tag::class => TagPolicy::class,
        User::class => UserPolicy::class,
    ];

    public function boot(): void
    {
        //
    }
}
