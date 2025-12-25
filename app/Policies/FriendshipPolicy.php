<?php

namespace App\Policies;

use App\Models\Friendship;
use App\Models\User;

class FriendshipPolicy
{
    public function accept(User $user, Friendship $friendship): bool
    {
        return $user->id === $friendship->friend_id && $friendship->status === 'pending';
    }

    public function decline(User $user, Friendship $friendship): bool
    {
        return $user->id === $friendship->friend_id && $friendship->status === 'pending';
    }

    public function cancel(User $user, Friendship $friendship): bool
    {
        return $user->id === $friendship->user_id && $friendship->status === 'pending';
    }
}