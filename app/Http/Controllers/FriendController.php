<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FriendController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $user = auth()->user();
        
        $friends = $user->friends;
        
        $pendingRequests = $user->pendingFriendRequests()->with('user')->get();
        
        $sentRequests = $user->sentFriendRequests()->with('friend')->get();

        return view('friendlist', compact('user', 'friends', 'pendingRequests', 'sentRequests'));
    }

    public function sendRequest(Request $request)
    {
        $validated = $request->validate([
            'friend_id' => ['required', 'string'],
        ]);

        // Extract numeric ID from formatted ID (e.g., "BLM001" -> 1)
        $friendId = (int) preg_replace('/[^0-9]/', '', $validated['friend_id']);
        
        $friend = User::find($friendId);

        if (!$friend) {
            return back()->withErrors(['friend_id' => 'User Not Found. No user found with that ID.']);
        }

        if ($friend->id === auth()->id()) {
            return back()->withErrors(['friend_id' => 'Invalid Request. You cannot send a friend request to yourself.']);
        }

        // Check if already friends or request exists
        $existingFriendship = Friendship::where(function ($q) use ($friendId) {
            $q->where('user_id', auth()->id())->where('friend_id', $friendId);
        })->orWhere(function ($q) use ($friendId) {
            $q->where('user_id', $friendId)->where('friend_id', auth()->id());
        })->first();

        if ($existingFriendship) {
            if ($existingFriendship->status === 'accepted') {
                return back()->withErrors(['friend_id' => 'Already Friends. You are already friends with this user.']);
            }
            return back()->withErrors(['friend_id' => 'Request Already Sent. You have already sent a request to this user.']);
        }

        Friendship::create([
            'user_id' => auth()->id(),
            'friend_id' => $friendId,
            'status' => 'pending',
        ]);

        return back()->with('success', "Friend Request Sent! 🌱 Request sent to {$friend->first_name}.");
    }

    public function acceptRequest(Friendship $friendship)
    {
        $this->authorize('accept', $friendship);
        
        $friendship->update(['status' => 'accepted']);

        // Create reverse friendship
        Friendship::updateOrCreate(
            ['user_id' => $friendship->friend_id, 'friend_id' => $friendship->user_id],
            ['status' => 'accepted']
        );

        return back()->with('success', "Friend Added! 🌸 You are now friends with {$friendship->user->first_name}.");
    }

    public function declineRequest(Friendship $friendship)
    {
        $this->authorize('decline', $friendship);
        
        $friendship->delete();

        return back()->with('success', "Request Declined. Declined friend request from {$friendship->user->first_name}.");
    }

    public function cancelRequest(Friendship $friendship)
    {
        $this->authorize('cancel', $friendship);
        
        $friendship->delete();

        return back()->with('success', "Request Cancelled. Cancelled friend request to {$friendship->friend->first_name}.");
    }

    public function viewGarden(User $friend)
    {
        $user = auth()->user();
        
        // Check if they are friends
        $isFriend = $user->friends()->where('users.id', $friend->id)->exists();
        
        if (!$isFriend) {
            abort(403, 'You can only view gardens of your friends.');
        }

        $year = request('year', now()->year);
        $month = request('month', now()->month);

        $entries = $friend->journalEntries()
            ->whereYear('entry_date', $year)
            ->whereMonth('entry_date', $month)
            ->get();

        $entriesByDay = $entries->groupBy(fn($e) => \Carbon\Carbon::parse($e->entry_date)->day);
        
        $commonMood = $this->calculateCommonMood($entries);

        return view('friend-garden', compact('user', 'friend', 'year', 'month', 'entries', 'entriesByDay', 'commonMood'));
    }

    private function calculateCommonMood($entries): string
    {
        if ($entries->isEmpty()) {
            return '-';
        }

        $moodCounts = $entries->groupBy('mood')->map(fn($g) => $g->count());
        $maxMood = $moodCounts->sortDesc()->keys()->first();

        return \App\Models\JournalEntry::getMoodLabel($maxMood);
    }
}