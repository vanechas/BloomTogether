@extends('layouts.app')

@section('title', 'Journal')

@section('content')
<div class="gradient-garden min-vh-100">
    <main class="position-relative" style="padding-top: 6rem;">
        <div class="container pb-5">
            <!-- Header -->
            <div class="text-center mb-5">
                <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                    @include('partials.pixel-flower', ['mood' => 'happy', 'size' => 'md', 'animated' => true])
                    <h1 class="font-pixel fs-4 text-wood text-shadow-pixel mb-0">My Journal</h1>
                    @include('partials.pixel-flower', ['mood' => 'happy', 'size' => 'md', 'animated' => true])
                </div>
                <p class="font-body text-muted-foreground">Plant a new flower by writing your thoughts</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="pixel-card bg-cream-95 p-4 p-md-5">
                        <form method="POST" action="{{ route('journal.store') }}">
                            @csrf

                            <!-- Date & Time -->
                            <div class="mb-4">
                                <label class="form-label font-pixel small text-gold">Date</label>
                                <input
                                    type="date"
                                    name="entry_date"
                                    value="{{ old('entry_date', date('Y-m-d')) }}"
                                    max="{{ date('Y-m-d') }}"
                                    class="form-control form-control-bloom @error('entry_date') is-invalid @enderror"
                                    required
                                />
                                @error('entry_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Mood Selector -->
                            <div class="mb-4">
                                <label class="form-label font-pixel small text-gold">How are you feeling?</label>
                                <div class="d-flex flex-wrap gap-3 justify-content-center py-3">
                                    @php
                                    $moods = [
                                        ['value' => 'very-sad', 'emoji' => '😢', 'label' => 'Very Sad'],
                                        ['value' => 'sad', 'emoji' => '😔', 'label' => 'Sad'],
                                        ['value' => 'neutral', 'emoji' => '😐', 'label' => 'Neutral'],
                                        ['value' => 'happy', 'emoji' => '😊', 'label' => 'Happy'],
                                        ['value' => 'very-happy', 'emoji' => '😄', 'label' => 'Very Happy'],
                                    ];
                                    @endphp
                                    @foreach($moods as $mood)
                                    <label class="mood-option">
                                        <input type="radio" name="mood" value="{{ $mood['value'] }}" class="d-none" {{ old('mood') === $mood['value'] ? 'checked' : '' }} required>
                                        <div class="mood-btn text-center p-3 rounded-3">
                                            <span class="fs-2 d-block mb-1">{{ $mood['emoji'] }}</span>
                                            <span class="font-body small text-muted-foreground">{{ $mood['label'] }}</span>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                                @error('mood')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Journal Content -->
                            <div class="mb-4">
                                <label class="form-label font-pixel small text-gold">What's on your mind?</label>
                                <textarea
                                    name="content"
                                    rows="8"
                                    placeholder="Dear journal, today I..."
                                    class="form-control form-control-bloom parchment @error('content') is-invalid @enderror"
                                    required
                                >{{ old('content') }}</textarea>
                                @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary-bloom btn-lg px-5">
                                    🌱 Plant Entry
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection