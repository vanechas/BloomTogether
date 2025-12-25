<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'date_of_birth',
        'gender',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'date_of_birth' => 'date',
    ];

    public function journalEntries()
    {
        return $this->hasMany(JournalEntry::class);
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id')
            ->wherePivot('status', 'accepted')
            ->withTimestamps();
    }

    public function pendingFriendRequests()
    {
        return $this->hasMany(Friendship::class, 'friend_id')
            ->where('status', 'pending');
    }

    public function sentFriendRequests()
    {
        return $this->hasMany(Friendship::class, 'user_id')
            ->where('status', 'pending');
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getUserIdAttribute(): string
    {
        return 'BLM' . str_pad($this->id, 3, '0', STR_PAD_LEFT);
    }

    public function calculateStreak(): int
    {
        $today = now()->startOfDay();
        $entries = $this->journalEntries()
            ->where('entry_date', '<=', $today)
            ->selectRaw('DATE(entry_date) as entry_date')
            ->distinct()
            ->orderByDesc('entry_date')
            ->pluck('entry_date');

        if ($entries->isEmpty()) {
            return 0;
        }

        $streak = 0;
        $checkDate = $today->copy();

        foreach ($entries as $dateStr) {
            $entryDate = \Carbon\Carbon::parse($dateStr)->startOfDay();
            $diffDays = $checkDate->diffInDays($entryDate);

            if ($diffDays === 0) {
                $streak++;
                $checkDate->subDay();
            } elseif ($diffDays === 1 && $streak === 0) {
                $streak++;
                $checkDate = $entryDate->copy()->subDay();
            } else {
                break;
            }
        }

        return $streak;
    }
}