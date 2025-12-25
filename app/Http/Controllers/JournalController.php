<?php

namespace App\Http\Controllers;

use App\Models\JournalEntry;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JournalController extends Controller
{
    public function index()
    {
        return view('journal');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'entry_date' => ['required', 'date', 'before_or_equal:today'],
            'mood' => ['required', 'in:very-sad,sad,neutral,happy,very-happy'],
            'content' => ['required', 'string', 'max:10000'],
        ]);

        $today = Carbon::today()->toDateString();
        if ($validated['entry_date'] > $today) {
            return back()->withErrors([
                'entry_date' => 'You can only create journal entries for today or past dates.'
            ]);
        }

        auth()->user()->journalEntries()->create($validated);

        return back()->with('success', 'Entry Saved! ✨ Your journal entry has been added.');
    }

    // public function destroy(JournalEntry $entry)
    // {
    //     $this->authorize('delete', $entry);
        
    //     $entry->delete();

    //     return back()->with('success', 'Entry deleted. Your journal entry has been removed.');
    // }
}