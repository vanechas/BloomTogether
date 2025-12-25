@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="gradient-garden min-vh-100">
    <main style="padding-top: 6rem;">
        <div class="container pb-5">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <!-- Profile Card -->
                    <div class="pixel-card bg-cream-95 p-4 p-md-5 mb-4">
                        <!-- Avatar -->
                        <div class="text-center mb-4">
                            <div class="d-inline-block p-4 rounded-3" style="background-color: rgba(248, 202, 185, 0.3); border: 4px solid var(--wood-light);">
                                @include('partials.pixel-profile', ['size' => 96])
                            </div>
                        </div>
                        
                        <!-- Profile Fields -->
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PATCH')
                            
                            <div class="mb-3">
                                <label class="form-label font-pixel small text-gold">Username</label>
                                <p class="form-control-plaintext font-body bg-cream-dark rounded px-3 py-2">
                                    {{ $user->first_name }} {{ $user->last_name }}
                                </p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label font-pixel small text-gold">User ID</label>
                                <p class="form-control-plaintext font-body text-muted-foreground bg-cream-dark rounded px-3 py-2">
                                    {{ $user->user_id }}
                                </p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label font-pixel small text-gold">Email</label>
                                <p class="form-control-plaintext font-body bg-cream-dark rounded px-3 py-2">
                                    {{ $user->email }}
                                </p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label font-pixel small text-gold">Date of Birth</label>
                                <input
                                    type="date"
                                    name="date_of_birth"
                                    value="{{ $user->date_of_birth?->format('Y-m-d') }}"
                                    class="form-control form-control-bloom"
                                />
                            </div>

                            <div class="mb-4">
                                <label class="form-label font-pixel small text-gold">Gender</label>
                                <select name="gender" class="form-select form-control-bloom">
                                    <option value="">Select...</option>
                                    <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary-bloom">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Stats Card -->
                    <div class="pixel-card bg-cream-95 p-4 mb-4">
                        <h2 class="font-pixel small text-gold text-center mb-4">Your Garden Stats</h2>
                        
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="text-center p-3 rounded-3" style="background-color: rgba(248, 202, 185, 0.2);">
                                    <div class="mb-2 d-flex justify-content-center">
                                        @include('partials.pixel-flower', ['mood' => 'happy', 'size' => 'md'])
                                    </div>
                                    <p class="font-pixel fs-5 text-wood mb-0">{{ $stats['totalEntries'] }}</p>
                                    <p class="font-body small text-muted-foreground mb-0">Total Entries</p>
                                </div>
                            </div>
                            
                            <div class="col-6">
                                <div class="text-center p-3 rounded-3" style="background-color: rgba(237, 131, 131, 0.2);">
                                    <div class="mb-2 d-flex justify-content-center">
                                        @include('partials.pixel-flower', ['mood' => 'very-happy', 'size' => 'md'])
                                    </div>
                                    <p class="font-pixel fs-5 text-wood mb-0">{{ $stats['currentStreak'] }}</p>
                                    <p class="font-body small text-muted-foreground mb-0">Day Streak</p>
                                </div>
                            </div>
                            
                            <div class="col-6">
                                <div class="text-center p-3 rounded-3" style="background-color: rgba(197, 139, 29, 0.2);">
                                    <div class="mb-2 d-flex justify-content-center">
                                        @include('partials.pixel-icons', ['icon' => 'watering-can', 'size' => 40])
                                    </div>
                                    <p class="font-pixel small text-wood mb-0">{{ $stats['happiestMonth'] }}</p>
                                    <p class="font-body small text-muted-foreground mb-0">Happiest Month</p>
                                </div>
                            </div>
                            
                            <div class="col-6">
                                <div class="text-center p-3 rounded-3" style="background-color: rgba(107, 144, 77, 0.2);">
                                    <div class="mb-2 d-flex justify-content-center gap-1">
                                        @include('partials.pixel-flower', ['mood' => 'happy', 'size' => 'sm'])
                                        @include('partials.pixel-flower', ['mood' => 'happy', 'size' => 'sm'])
                                        @include('partials.pixel-flower', ['mood' => 'happy', 'size' => 'sm'])
                                    </div>
                                    <p class="font-pixel fs-5 text-wood mb-0">{{ $stats['longestStreak'] }}</p>
                                    <p class="font-body small text-muted-foreground mb-0">Longest Streak</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Logout -->
                    <div class="text-center">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-wood">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection