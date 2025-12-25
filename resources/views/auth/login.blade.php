@extends('layouts.app')

@section('title', 'Login')

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
            @include('partials.pixel-flower', ['mood' => 'happy', 'size' => 'lg', 'animated' => true])
        </div>
        <div class="position-absolute opacity-25" style="bottom: 8rem; right: 6rem;">
            @include('partials.pixel-flower', ['mood' => 'very-happy', 'size' => 'lg', 'animated' => true])
        </div>
    </div>
    
    <main class="pt-5 pb-4 position-relative" style="z-index: 10; padding-top: 7rem !important;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-5">
                    <!-- Header -->
                    <div class="text-center mb-4">
                        <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                            @include('partials.pixel-flower', ['mood' => 'happy', 'size' => 'md'])
                            <h1 class="font-pixel fs-5 text-wood mb-0">Welcome Back</h1>
                            @include('partials.pixel-flower', ['mood' => 'happy', 'size' => 'md'])
                        </div>
                        <p class="font-body text-muted-foreground">Continue your journey of growth</p>
                    </div>

                    <!-- Form Card -->
                    <div class="pixel-card bg-cream-95 p-4 p-md-5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            @if($errors->has('email') && str_contains($errors->first('email'), 'Invalid'))
                            <div class="alert alert-danger-bloom mb-4">
                                <p class="mb-0 small text-center">{{ $errors->first('email') }}</p>
                            </div>
                            @endif

                            <!-- Email -->
                            <div class="mb-4">
                                <label class="form-label font-pixel small text-gold">Email *</label>
                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="gardener@email.com"
                                    class="form-control form-control-bloom @error('email') is-invalid @enderror"
                                    required
                                />
                                @error('email')
                                    @if(!str_contains($message, 'Invalid'))
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @endif
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-4">
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
                            </div>

                            <!-- Forgot Password -->
                            <div class="text-end mb-4">
                                <a href="{{ route('password.request') }}" class="text-gold text-decoration-none font-body small">
                                    Forgot Password?
                                </a>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary-bloom w-100">
                                Login
                            </button>
                        </form>

                        <!-- Register Link -->
                        <div class="mt-4 text-center">
                            <p class="font-body small text-muted-foreground mb-0">
                                Don't have an account?
                                <a href="{{ route('register') }}" class="text-gold text-decoration-none fw-semibold ms-1">
                                    Register Now
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