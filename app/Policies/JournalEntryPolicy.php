<?php

namespace App\Policies;

use App\Models\JournalEntry;
use App\Models\User;

class JournalEntryPolicy
{
    public function delete(User $user, JournalEntry $entry): bool
    {
        return $user->id === $entry->user_id;
    }
}