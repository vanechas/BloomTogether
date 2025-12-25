<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'entry_date',
        'mood',
        'content',
    ];

    protected $casts = [
        'entry_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getMoodEmoji(string $mood): string
    {
        return match($mood) {
            'very-sad' => '😢',
            'sad' => '😔',
            'neutral' => '😐',
            'happy' => '😊',
            'very-happy' => '😄',
            default => '😐',
        };
    }

    public static function getMoodLabel(string $mood): string
    {
        return match($mood) {
            'very-sad' => 'Very Sad',
            'sad' => 'Sad',
            'neutral' => 'Neutral',
            'happy' => 'Happy',
            'very-happy' => 'Very Happy',
            default => 'Neutral',
        };
    }
}