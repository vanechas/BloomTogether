<?php

namespace App\Http\Controllers;

use App\Models\JournalEntry;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GardenController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);

        $entries = $user->journalEntries()
            ->whereYear('entry_date', $year)
            ->whereMonth('entry_date', $month)
            ->get();

        $entriesByDay = $entries->groupBy(fn($e) => Carbon::parse($e->entry_date)->day);
        
        $streak = $user->calculateStreak();
        
        $commonMood = $this->calculateCommonMood($entries);

        return view('garden', compact(
            'user', 
            'year', 
            'month', 
            'entries', 
            'entriesByDay', 
            'streak',
            'commonMood'
        ));
    }

    public function getEntriesByDate(Request $request)
    {
        $date = $request->get('date');
        $entries = auth()->user()->journalEntries()
            ->whereDate('entry_date', $date)
            ->get();

        return response()->json($entries);
    }

    private function calculateCommonMood($entries): string
    {
        if ($entries->isEmpty()) {
            return '-';
        }

        $moodCounts = $entries->groupBy('mood')
            ->map(fn($group) => $group->count());

        $maxMood = $moodCounts->keys()->first();
        $maxCount = 0;

        foreach ($moodCounts as $mood => $count) {
            if ($count > $maxCount) {
                $maxCount = $count;
                $maxMood = $mood;
            }
        }

        return JournalEntry::getMoodLabel($maxMood);
    }
}