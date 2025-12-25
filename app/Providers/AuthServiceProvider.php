<?php

namespace App\Providers;

use App\Models\Friendship;
use App\Models\JournalEntry;
use App\Policies\FriendshipPolicy;
use App\Policies\JournalEntryPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        JournalEntry::class => JournalEntryPolicy::class,
        Friendship::class => FriendshipPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}