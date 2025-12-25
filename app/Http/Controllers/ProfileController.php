<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $entries = $user->journalEntries;
        $streak = $user->calculateStreak();

        $stats = [
            'totalEntries' => $entries->count(),
            'currentStreak' => $streak,
            'happiestMonth' => $entries->count() > 0 ? 'This month' : '-',
            'longestStreak' => $streak,
        ];

        return view('profile', compact('user', 'stats'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['sometimes', 'string', 'max:255'],
            'last_name' => ['sometimes', 'string', 'max:255'],
            'date_of_birth' => ['sometimes', 'nullable', 'date'],
            'gender' => ['sometimes', 'nullable', 'in:male,female'],
        ]);

        auth()->user()->update($validated);

        return back()->with('success', 'Profile Updated! Your changes have been saved.');
    }
}