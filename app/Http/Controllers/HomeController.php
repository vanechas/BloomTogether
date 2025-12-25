<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $recentEntries = $user->journalEntries()
            ->orderByDesc('entry_date')
            ->limit(3)
            ->get();

        return view('home', compact('user', 'recentEntries'));
    }
}