@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="gradient-sky min-vh-100">
    <!-- Background decorations -->
    <div class="position-fixed w-100 h-100" style="pointer-events: none;">
        <div class="position-absolute" style="top: 8rem; left: 15%;">
            @include('partials.pixel-sparkle', ['delay' => 0, 'size' => 12])
        </div>
        <div class="position-absolute" style="top: 12rem; right: 20%;">
            @include('partials.pixel-sparkle', ['delay' => 0.5, 'size' => 10, 'color' => '#ED8383'])
        </div>
        
        <div class="position-absolute opacity-25" style="bottom: 5rem; left: 5rem;">
            @include('partials.pixel-flower', ['mood' => 'neutral', 'size' => 'lg', 'animated' => true])
        </div>
        <div class="position-absolute opacity-25" style="bottom: 8rem; right: 6rem;">
            @include('partials.pixel-flower', ['mood' => 'happy', 'size' => 'lg', 'animated' => true])
        </div>
    </div>
    
    <main class="pt-5 pb-4 position-relative" style="z-index: 10; padding-top: 7rem !important;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-5">
                    <!-- Header -->
                    <div class="text-center mb-4">
                        <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                            @include('partials.pixel-flower', ['mood' => 'neutral', 'size' => 'md'])
                            <h1 class="font-pixel fs-5 text-wood mb-0">Join Us</h1>
                            @include('partials.pixel-flower', ['mood' => 'neutral', 'size' => 'md'])
                        </div>
                        <p class="font-body text-muted-foreground">Start your journey to emotional wellness</p>
                    </div>

                    <!-- Form Card -->
                    <div class="pixel-card bg-cream-95 p-4 p-md-5">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- First Name -->
                            <div class="mb-3">
                                <label class="form-label font-pixel small text-gold">First Name *</label>
                                <input
                                    type="text"
                                    name="first_name"
                                    value="{{ old('first_name') }}"
                                    placeholder="Your first name"
                                    class="form-control form-control-bloom @error('first_name') is-invalid @enderror"
                                    required
                                />
                                @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Last Name -->
                            <div class="mb-3">
                                <label class="form-label font-pixel small text-gold">Last Name *</label>
                                <input
                                    type="text"
                                    name="last_name"
                                    value="{{ old('last_name') }}"
                                    placeholder="Your last name"
                                    class="form-control form-control-bloom @error('last_name') is-invalid @enderror"
                                    required
                                />
                                @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label font-pixel small text-gold">Email *</label>
                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="your@email.com"
                                    class="form-control form-control-bloom @error('email') is-invalid @enderror"
                                    required
                                />
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label class="form-label font-pixel small text-gold">Password *</label>
                                <input
                                    type="password"
                                    name="password"
                                    placeholder="••••••••"
                                    class="form-control form-control-bloom @error('password') is-invalid @enderror"
                                    required
                                />
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted-foreground">Min 8 chars, must include number & symbol</small>
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label class="form-label font-pixel small text-gold">Confirm Password *</label>
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    placeholder="••••••••"
                                    class="form-control form-control-bloom"
                                    required
                                />
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary-bloom w-100">
                                Register
                            </button>
                        </form>

                        <!-- Login Link -->
                        <div class="mt-4 text-center">
                            <p class="font-body small text-muted-foreground mb-0">
                                Already have an account?
                                <a href="{{ route('login') }}" class="text-gold text-decoration-none fw-semibold ms-1">
                                    Login
                                </a>
                            </p>
                        </div>
                    </div>

                    <!-- Back to home -->
                    <div class="mt-4 text-center">
                        <a href="{{ route('landing') }}" class="font-body small text-muted-foreground text-decoration-none">
                            ← Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection