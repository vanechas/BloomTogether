@extends('layouts.app')

@section('title', $friend->first_name . "'s Garden")

@section('content')
<div class="gradient-garden min-vh-100">
    <!-- Background decorations -->
    <div class="position-fixed w-100 h-100 overflow-hidden" style="pointer-events: none;">
        <div class="position-absolute cloud-drift opacity-25" style="top: 5rem; left: 10%;">
            @include('partials.pixel-cloud', ['size' => 'md'])
        </div>
        <div class="position-absolute cloud-drift-slow opacity-25" style="top: 7rem; right: 5%;">
            @include('partials.pixel-cloud', ['size' => 'lg'])
        </div>
    </div>
    
    <main class="position-relative" style="padding-top: 6rem; z-index: 10;">
        <div class="container pb-5">
            <!-- Header -->
            <div class="text-center mb-4">
                <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                    <a href="{{ route('friendlist') }}" class="text-wood text-decoration-none">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <h1 class="font-pixel fs-4 text-wood text-shadow-pixel mb-0">
                        {{ $friend->first_name }}'s Garden
                    </h1>
                </div>
                <p class="font-body text-muted-foreground">
                    Viewing {{ $friend->first_name }}'s emotional garden
                </p>
            </div>

            <!-- Friend Info Card -->
            <div class="row justify-content-center mb-4">
                <div class="col-12 col-lg-10">
                    <div class="pixel-card bg-cream-90 p-3 d-flex align-items-center gap-3">
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
                </div>
            </div>

            <!-- Calendar -->
            <div class="pixel-card bg-cream-90 p-4">
                @include('partials.garden-calendar', [
                    'year' => $year,
                    'month' => $month,
                    'entriesByDay' => $entriesByDay,
                    'streak' => 0,
                    'commonMood' => $commonMood,
                    'isFriendGarden' => true,
                    'friendId' => $friend->id
                ])
            </div>
        </div>
    </main>
</div>

<!-- Journal Entries Modal (Read-only for friend garden) -->
<!-- <div class="modal fade" id="entriesModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pixel-card bg-cream border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title font-pixel small text-wood">Journal Entries - <span id="modal-date"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modal-entries" style="max-height: 60vh; overflow-y: auto;"></div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-bloom w-100" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
const entriesModal = new bootstrap.Modal(document.getElementById('entriesModal'));

function openModal(date, entries) {
    document.getElementById('modal-date').textContent = date;
    const container = document.getElementById('modal-entries');
    container.innerHTML = '';
    
    if (entries.length === 0) {
        container.innerHTML = '<p class="font-body text-muted-foreground text-center py-4">No entries for this date.</p>';
    } else {
        const moodEmojis = {
            'very-sad': '😢', 'sad': '😔', 'neutral': '😐', 'happy': '😊', 'very-happy': '😄'
        };
        const moodLabels = {
            'very-sad': 'Very Sad', 'sad': 'Sad', 'neutral': 'Neutral', 'happy': 'Happy', 'very-happy': 'Very Happy'
        };
        
        entries.forEach((entry, index) => {
            // Read-only view - no delete button for friend's entries
            container.innerHTML += `
                <div class="parchment p-3 mb-3">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="fs-4">${moodEmojis[entry.mood]}</span>
                        <span class="font-body small">${moodLabels[entry.mood]}</span>
                    </div>
                    <p class="font-body mb-0">${entry.content}</p>
                    ${entries.length > 1 ? `<p class="font-body small text-muted-foreground mt-2 mb-0">Entry ${index + 1} of ${entries.length}</p>` : ''}
                </div>
            `;
        });
    }
    
    entriesModal.show();
} -->
</script>
@endpush
@endsection