@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="gradient-sky min-vh-100">
    <main class="pt-5 pb-4 position-relative" style="z-index: 10; padding-top: 7rem !important;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-5">
                    <!-- Header -->
                    <div class="text-center mb-4">
                        <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                            @include('partials.pixel-flower', ['mood' => 'neutral', 'size' => 'md'])
                            <h1 class="font-pixel fs-5 text-wood mb-0">Reset Password</h1>
                            @include('partials.pixel-flower', ['mood' => 'neutral', 'size' => 'md'])
                        </div>
                        <p class="font-body text-muted-foreground">Enter your email and new password</p>
                    </div>

                    <!-- Form Card -->
                    <div class="pixel-card bg-cream-95 p-4 p-md-5">
                        <form method="POST" action="{{ route('password.reset') }}">
                            @csrf

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

                            <!-- New Password -->
                            <div class="mb-3">
                                <label class="form-label font-pixel small text-gold">New Password *</label>
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
                                Reset Password
                            </button>
                        </form>

                        <!-- Back to Login -->
                        <div class="mt-4 text-center">
                            <a href="{{ route('login') }}" class="font-body small text-muted-foreground text-decoration-none">
                                ← Back to Login
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection