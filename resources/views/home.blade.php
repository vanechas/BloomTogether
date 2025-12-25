@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="gradient-sunset min-vh-100">
    <main class="position-relative overflow-hidden" style="padding-top: 6rem;">
        <!-- Background flowers -->
        <div class="position-absolute w-100 h-100 opacity-25" style="pointer-events: none;">
            <div class="position-absolute" style="left: 5%; top: 20%;">@include('partials.pixel-flower', ['mood' => 'happy', 'size' => 'sm'])</div>
            <div class="position-absolute" style="left: 13%; top: 40%;">@include('partials.pixel-flower', ['mood' => 'very-happy', 'size' => 'sm'])</div>
            <div class="position-absolute" style="right: 10%; top: 25%;">@include('partials.pixel-flower', ['mood' => 'very-happy', 'size' => 'sm'])</div>
            <div class="position-absolute" style="right: 20%; top: 50%;">@include('partials.pixel-flower', ['mood' => 'neutral', 'size' => 'sm'])</div>
        </div>

        <!-- Sparkles -->
        <div class="position-absolute w-100 h-100" style="pointer-events: none;">
            <div class="position-absolute" style="top: 8rem; left: 20%;">
                @include('partials.pixel-sparkle', ['delay' => 0, 'size' => 10])
            </div>
            <div class="position-absolute" style="top: 12rem; right: 25%;">
                @include('partials.pixel-sparkle', ['delay' => 1, 'size' => 12, 'color' => '#ED8383'])
            </div>
        </div>

        <div class="container position-relative pb-5" style="z-index: 10;">
            <!-- Mascot Welcome Section -->
            <div class="row align-items-center justify-content-center mb-5">
                <div class="col-auto">
                    <!-- Mascot -->
                    <div class="animate-float">
                        @include('partials.pixel-mascot', ['size' => 100])
                    </div>
                </div>
                <div class="col-auto">
                    <!-- Speech Bubble -->
                    <div class="pixel-card bg-cream px-4 py-3 position-relative">
                        <p class="font-pixel small text-wood text-center mb-1">Hello, {{ $user->first_name }}!</p>
                        <p class="font-body small text-muted-foreground text-center mb-0">Ready to tend your garden today?</p>
                    </div>
                </div>
            </div>

            <!-- Quick Access Cards -->
            <div class="row g-4 justify-content-center">
                <!-- Journal Card -->
                <div class="col-md-4">
                    <a href="{{ route('journal') }}" class="text-decoration-none">
                        <div class="pixel-card bg-cream h-100 text-center p-4 feature-card">
                            <div class="mb-3 p-3 rounded-3 d-inline-block" style="background-color: rgba(237, 131, 131, 0.2);">
                                @include('partials.pixel-icons', ['icon' => 'notebook', 'size' => 56])
                            </div>
                            <h3 class="font-pixel small text-gold mb-2">Journal</h3>
                            <p class="font-body small text-muted-foreground mb-3">Write your thoughts and plant a new flower</p>
                            <span class="btn btn-primary-bloom btn-sm">Write Entry</span>
                        </div>
                    </a>
                </div>

                <!-- Garden Card -->
                <div class="col-md-4">
                    <a href="{{ route('garden') }}" class="text-decoration-none">
                        <div class="pixel-card bg-cream h-100 text-center p-4 feature-card">
                            <div class="mb-3 p-3 rounded-3 d-inline-block" style="background-color: rgba(107, 144, 77, 0.2);">
                                @include('partials.pixel-icons', ['icon' => 'sprout', 'size' => 56])
                            </div>
                            <h3 class="font-pixel small text-gold mb-2">Garden</h3>
                            <p class="font-body small text-muted-foreground mb-3">View your emotional garden calendar</p>
                            <span class="btn btn-primary-bloom btn-sm">View Garden</span>
                        </div>
                    </a>
                </div>

                <!-- Friends Card -->
                <div class="col-md-4">
                    <a href="{{ route('friendlist') }}" class="text-decoration-none">
                        <div class="pixel-card bg-cream h-100 text-center p-4 feature-card">
                            <div class="mb-3 p-3 rounded-3 d-inline-block" style="background-color: rgba(197, 139, 29, 0.2);">
                                @include('partials.pixel-icons', ['icon' => 'friends', 'size' => 56])
                            </div>
                            <h3 class="font-pixel small text-gold mb-2">Friends</h3>
                            <p class="font-body small text-muted-foreground mb-3">Connect with friends and share journeys</p>
                            <span class="btn btn-primary-bloom btn-sm">View Friends</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection