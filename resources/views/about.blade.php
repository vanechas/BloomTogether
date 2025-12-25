@extends('layouts.app')

@section('title', 'About')

@section('content')
<div class="gradient-sky min-vh-100">
    <main style="padding-top: 6rem;">
        <div class="container pb-5">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="text-center mb-5">
                        <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                            @include('partials.pixel-flower', ['mood' => 'very-happy', 'size' => 'md', 'animated' => true])
                            <h1 class="font-pixel fs-4 text-wood text-shadow-pixel mb-0">About Bloom Together</h1>
                            @include('partials.pixel-flower', ['mood' => 'very-happy', 'size' => 'md', 'animated' => true])
                        </div>
                    </div>

                    <div class="pixel-card bg-cream-95 p-4 p-md-5 mb-4">
                        <h2 class="font-pixel small text-gold mb-3">Our Mission</h2>
                        <p class="font-body text-muted-foreground">
                            Bloom Together is a cozy mental wellness companion designed to help you nurture your emotional well-being. 
                            We believe that self-care should feel gentle, supportive, and even a little bit magical.
                        </p>
                        <p class="font-body text-muted-foreground mb-0">
                            Through daily journaling and our unique garden visualization, we help you track your emotional journey, 
                            celebrate your progress, and grow alongside friends who support you.
                        </p>
                    </div>

                    <div class="pixel-card bg-cream-95 p-4 p-md-5 mb-4">
                        <h2 class="font-pixel small text-gold mb-3">How It Works</h2>
                        <div class="row g-4">
                            <div class="col-md-4 text-center">
                                @include('partials.pixel-icons', ['icon' => 'notebook', 'size' => 48])
                                <h3 class="font-pixel small text-wood mt-3 mb-2">1. Write</h3>
                                <p class="font-body small text-muted-foreground mb-0">Express your feelings in your personal journal</p>
                            </div>
                            <div class="col-md-4 text-center">
                                @include('partials.pixel-icons', ['icon' => 'sprout', 'size' => 48])
                                <h3 class="font-pixel small text-wood mt-3 mb-2">2. Grow</h3>
                                <p class="font-body small text-muted-foreground mb-0">Watch your garden bloom with each entry</p>
                            </div>
                            <div class="col-md-4 text-center">
                                @include('partials.pixel-icons', ['icon' => 'friends', 'size' => 48])
                                <h3 class="font-pixel small text-wood mt-3 mb-2">3. Connect</h3>
                                <p class="font-body small text-muted-foreground mb-0">Support friends on their wellness journey</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('register') }}" class="btn btn-primary-bloom btn-lg">Start Your Journey</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection