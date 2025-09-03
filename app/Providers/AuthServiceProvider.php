<?php

namespace App\Providers;

use App\Models\ {
    Post,
    Tag,
    User,
};
use App\Policies\{
    PostPolicy,
    TagPolicy,
    UserPolicy,
};
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Post::class => PostPolicy::class,
        Tag::class => TagPolicy::class,
        User::class => UserPolicy::class,
    ];

    public function boot(): void
    {
        //
    }
}
