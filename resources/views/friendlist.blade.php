@extends('layouts.app')

@section('title', 'Friendlist')

@section('content')
<div class="gradient-sunset min-vh-100">
    <main style="padding-top: 6rem;">
        <div class="container pb-5">
            <!-- Header -->
            <div class="text-center mb-4">
                <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                    @include('partials.pixel-flower', ['mood' => 'happy', 'size' => 'md', 'animated' => true])
                    <h1 class="font-pixel fs-4 text-wood text-shadow-pixel mb-0">Friendlist</h1>
                    @include('partials.pixel-flower', ['mood' => 'happy', 'size' => 'md', 'animated' => true])
                </div>
                <p class="font-body text-muted-foreground">Visit your friends' gardens and support their journey</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <!-- Tabs -->
                    <ul class="nav nav-pills nav-fill mb-4 p-1 rounded-3" style="background-color: rgba(255, 253, 243, 0.8); border: 4px solid var(--wood-light);">
                        <li class="nav-item">
                            <button class="nav-link active font-pixel small" data-bs-toggle="pill" data-bs-target="#friends-tab">
                                Friends ({{ $friends->count() }})
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link font-pixel small" data-bs-toggle="pill" data-bs-target="#pending-tab">
                                Pending ({{ $pendingRequests->count() }})
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link font-pixel small" data-bs-toggle="pill" data-bs-target="#sent-tab">
                                Sent ({{ $sentRequests->count() }})
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- Friends Tab -->
                        <div class="tab-pane fade show active" id="friends-tab">
                            <!-- Add Friend Form -->
                            <div class="pixel-card bg-cream-95 p-4 mb-4">
                                <form method="POST" action="{{ route('friendship.request') }}" class="d-flex flex-column flex-sm-row gap-3">
                                    @csrf
                                    <input
                                        type="text"
                                        name="friend_id"
                                        placeholder="Enter User ID (e.g., BLM001)"
                                        class="form-control form-control-bloom flex-grow-1"
                                        required
                                    />
                                    <button type="submit" class="btn btn-primary-bloom">Add Friend</button>
                                </form>
                                @error('friend_id')
                                <p class="text-coral small mt-2 mb-0">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Friends List -->
                            @if($friends->isEmpty())
                            <div class="pixel-card bg-cream-95 p-5 text-center">
                                <div class="mb-3 d-flex justify-content-center">
                                    @include('partials.pixel-icons', ['icon' => 'friends', 'size' => 64])
                                </div>
                                <p class="font-pixel small text-wood mb-2">No friends yet</p>
                                <p class="font-body small text-muted-foreground mb-0">Add friends using their User ID to see their gardens!</p>
                            </div>
                            @else
                            <div class="row g-3">
                                @foreach($friends as $friend)
                                <div class="col-12">
                                    <div class="pixel-card bg-cream-95 p-3 d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: rgba(248, 202, 185, 0.5);">
                                                <span class="font-pixel small text-wood">
                                                    {{ strtoupper(substr($friend->first_name, 0, 1)) }}{{ strtoupper(substr($friend->last_name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <p class="font-pixel small text-wood mb-0">{{ $friend->full_name }}</p>
                                                <p class="font-body small text-muted-foreground mb-0">{{ $friend->user_id }}</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('friend.garden', $friend) }}" class="btn btn-outline-bloom btn-sm">View Garden</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>

                        <!-- Pending Tab -->
                        <div class="tab-pane fade" id="pending-tab">
                            @if($pendingRequests->isEmpty())
                            <div class="pixel-card bg-cream-95 p-5 text-center">
                                <p class="font-body text-muted-foreground mb-0">No pending requests</p>
                            </div>
                            @else
                            <div class="row g-3">
                                @foreach($pendingRequests as $request)
                                <div class="col-12">
                                    <div class="pixel-card bg-cream-95 p-3 d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: rgba(248, 202, 185, 0.5);">
                                                <span class="font-pixel small text-wood">
                                                    {{ strtoupper(substr($request->user->first_name, 0, 1)) }}{{ strtoupper(substr($request->user->last_name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <p class="font-pixel small text-wood mb-0">{{ $request->user->full_name }}</p>
                                                <p class="font-body small text-muted-foreground mb-0">{{ $request->user->user_id }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <form action="{{ route('friendship.accept', $request) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary-bloom btn-sm">Accept</button>
                                            </form>
                                            <form action="{{ route('friendship.decline', $request) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-coral btn-sm">Decline</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>

                        <!-- Sent Tab -->
                        <div class="tab-pane fade" id="sent-tab">
                            @if($sentRequests->isEmpty())
                            <div class="pixel-card bg-cream-95 p-5 text-center">
                                <p class="font-body text-muted-foreground mb-0">No sent requests</p>
                            </div>
                            @else
                            <div class="row g-3">
                                @foreach($sentRequests as $request)
                                <div class="col-12">
                                    <div class="pixel-card bg-cream-95 p-3 d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: rgba(248, 202, 185, 0.5);">
                                                <span class="font-pixel small text-wood">
                                                    {{ strtoupper(substr($request->friend->first_name, 0, 1)) }}{{ strtoupper(substr($request->friend->last_name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <p class="font-pixel small text-wood mb-0">{{ $request->friend->full_name }}</p>
                                                <p class="font-body small text-muted-foreground mb-0">{{ $request->friend->user_id }}</p>
                                            </div>
                                        </div>
                                        <form action="{{ route('friendship.cancel', $request) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-bloom btn-sm">Cancel</button>
                                        </form>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection