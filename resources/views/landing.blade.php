@extends('layouts.app')

@section('title', 'A Cozy Mental Health Journey')

@section('content')
<section class="gradient-sky min-vh-100 position-relative overflow-hidden pt-5">
    <!-- Floating clouds -->
    <div class="position-absolute w-100 h-100 overflow-hidden" style="pointer-events: none;">
        <div class="position-absolute cloud-drift" style="top: 6rem; left: 5%;">
            @include('partials.pixel-cloud', ['size' => 'lg'])
        </div>
        <div class="position-absolute cloud-drift-slow" style="top: 8rem; right: 10%;">
            @include('partials.pixel-cloud', ['size' => 'md'])
        </div>
        <div class="position-absolute cloud-drift" style="top: 12rem; left: 40%; animation-delay: -20s;">
            @include('partials.pixel-cloud', ['size' => 'sm'])
        </div>
    </div>

    <!-- Floating sparkles -->
    <div class="position-absolute w-100 h-100" style="pointer-events: none;">
        <div class="position-absolute" style="top: 30%; left: 15%;">
            @include('partials.pixel-sparkle', ['delay' => 0, 'size' => 12])
        </div>
        <div class="position-absolute" style="top: 25%; right: 20%;">
            @include('partials.pixel-sparkle', ['delay' => 0.5, 'size' => 10, 'color' => '#ED8383'])
        </div>
        <div class="position-absolute" style="top: 45%; left: 25%;">
            @include('partials.pixel-sparkle', ['delay' => 1, 'size' => 8])
        </div>
        <div class="position-absolute" style="top: 35%; right: 30%;">
            @include('partials.pixel-sparkle', ['delay' => 1.5, 'size' => 14, 'color' => '#6B904D'])
        </div>
    </div>

    <!-- Main content -->
    <div class="container pt-5 pb-4 position-relative" style="z-index: 10;">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 text-center">
                <!-- Logo -->
                <div class="d-flex align-items-center justify-content-center mb-4 animate-float">
                    <h1 class="font-pixel fs-2 text-wood text-shadow-pixel mb-0">Bloom</h1>
                    <div class="mx-3">
                        @include('partials.pixel-flower', ['mood' => 'very-happy', 'size' => 'lg', 'animated' => true])
                    </div>
                    <h1 class="font-pixel fs-2 text-wood text-shadow-pixel mb-0">Together</h1>
                </div>

                <!-- Mascot -->
                <div class="mb-4 animate-float" style="animation-delay: 0.2s;">
                    @include('partials.pixel-mascot', ['size' => 120])
                </div>

                <!-- Tagline -->
                <p class="font-body fs-4 text-wood mb-4">
                    🌱 Your cozy corner for mental wellness 🌱
                </p>
                <p class="font-body text-muted-foreground mb-5">
                    Plant seeds of self-care, watch your emotional garden bloom, and grow together with friends.
                </p>

                <!-- CTA Buttons -->
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center mb-5">
                    <a href="{{ route('register') }}" class="btn btn-primary-bloom btn-lg px-5">
                        Start Your Garden
                    </a>
                    <a href="{{ route('about') }}" class="btn btn-outline-bloom btn-lg px-4">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 gradient-sunset">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="font-pixel fs-4 text-wood mb-3">How It Works</h2>
            <p class="font-body text-muted-foreground">Three simple steps to nurture your wellbeing</p>
        </div>

        <div class="row g-4">
            @php
            $features = [
                ['icon' => 'notebook', 'title' => 'Write Daily', 'desc' => 'Express your thoughts and feelings in your personal journal. Each entry plants a new flower in your garden.'],
                ['icon' => 'sprout', 'title' => 'Watch It Grow', 'desc' => 'Your garden visualizes your emotional journey. See patterns and celebrate your growth over time.'],
                ['icon' => 'friends', 'title' => 'Bloom Together', 'desc' => 'Connect with friends and support each other. Visit their gardens and share the journey.'],
            ];
            @endphp

            @foreach($features as $feature)
            <div class="col-md-4">
                <div class="pixel-card bg-cream h-100 text-center p-4 feature-card">
                    <div class="mb-3 d-flex justify-content-center">
                        <div class="p-3 rounded-3" style="background-color: rgba(248, 202, 185, 0.5);">
                            @include('partials.pixel-icons', ['icon' => $feature['icon'], 'size' => 56])
                        </div>
                    </div>
                    <h3 class="font-pixel fs-6 text-gold mb-2">{{ $feature['title'] }}</h3>
                    <p class="font-body text-muted-foreground small mb-0">{{ $feature['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-5 bg-cream">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="font-pixel fs-4 text-wood mb-3">Meet the Gardeners</h2>
            <p class="font-body text-muted-foreground">The people who planted this garden</p>
        </div>

        <div class="row g-4 justify-content-center">
            @php
            $team = [
                ['name' => 'Amanda Sugito', 'role' => 'UI/UX Designer', 'initials' => 'AS'],
                ['name' => 'Asyifa Izzatil', 'role' => 'Back End Developer', 'initials' => 'AI'],
                ['name' => 'Vanessa Santoso', 'role' => 'Front End Developer', 'initials' => 'VS'],
            ];
            @endphp

            @foreach($team as $member)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="pixel-card bg-cream h-100 text-center p-4">
                    <div class="mb-3 d-flex justify-content-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 64px; height: 64px; background-color: rgba(248, 202, 185, 0.5);">
                            <span class="font-pixel small text-wood">{{ $member['initials'] }}</span>
                        </div>
                    </div>
                    <h4 class="font-pixel small text-wood mb-1">{{ $member['name'] }}</h4>
                    <p class="font-body small text-gold mb-0">{{ $member['role'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="py-4 bg-wood-light-20">
    <div class="container text-center">
        <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
            @include('partials.pixel-flower', ['mood' => 'happy', 'size' => 'sm'])
            <span class="font-pixel small text-wood">Bloom Together</span>
            @include('partials.pixel-flower', ['mood' => 'happy', 'size' => 'sm'])
        </div>
        <p class="font-body small text-muted-foreground mb-1">Made with 💚 for your mental wellness</p>
        <p class="font-body small text-muted-foreground mb-0">© {{ date('Y') }} Bloom Together. Grow through what you go through.</p>
    </div>
</footer>
@endsection