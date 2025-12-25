@php
$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
$days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

$firstDayOfMonth = \Carbon\Carbon::create($year, $month, 1)->dayOfWeek;
$daysInMonth = \Carbon\Carbon::create($year, $month, 1)->daysInMonth;
$today = now();
$isCurrentMonth = $today->year === $year && $today->month === $month;
$todayDate = $today->day;

$decorativeFlowerMoods = ['very-happy', 'happy', 'neutral', 'sad', 'very-sad'];
$getDecorativeFlowerMood = function($day, $month) use ($decorativeFlowerMoods) {
    $seed = $day * 13 + $month * 7;
    return $decorativeFlowerMoods[$seed % count($decorativeFlowerMoods)];
};

$baseUrl = ($isFriendGarden ?? false) ? "/friendlist/{$friendId}/garden" : "/garden";
@endphp

<div class="row">
    <!-- Calendar Grid -->
    <div class="col-12 col-lg-8">
        <!-- Month Navigation -->
        <div class="d-flex align-items-center justify-content-between mb-4 px-2">
            <a href="{{ $baseUrl }}?year={{ $month == 1 ? $year - 1 : $year }}&month={{ $month == 1 ? 12 : $month - 1 }}" 
               class="btn btn-link text-wood p-2">
                <svg width="24" height="24" viewBox="0 0 8 8" class="pixel-render" style="shape-rendering: crispEdges">
                    <rect x="3" y="1" width="1" height="1" fill="currentColor" />
                    <rect x="2" y="2" width="1" height="1" fill="currentColor" />
                    <rect x="1" y="3" width="1" height="2" fill="currentColor" />
                    <rect x="2" y="5" width="1" height="1" fill="currentColor" />
                    <rect x="3" y="6" width="1" height="1" fill="currentColor" />
                    <rect x="2" y="3" width="5" height="2" fill="currentColor" />
                </svg>
            </a>
            
            <h2 class="font-pixel small text-wood mb-0">{{ $months[$month - 1] }} {{ $year }}</h2>
            
            <a href="{{ $baseUrl }}?year={{ $month == 12 ? $year + 1 : $year }}&month={{ $month == 12 ? 1 : $month + 1 }}" 
               class="btn btn-link text-wood p-2">
                <svg width="24" height="24" viewBox="0 0 8 8" class="pixel-render" style="shape-rendering: crispEdges">
                    <rect x="4" y="1" width="1" height="1" fill="currentColor" />
                    <rect x="5" y="2" width="1" height="1" fill="currentColor" />
                    <rect x="6" y="3" width="1" height="2" fill="currentColor" />
                    <rect x="5" y="5" width="1" height="1" fill="currentColor" />
                    <rect x="4" y="6" width="1" height="1" fill="currentColor" />
                    <rect x="1" y="3" width="5" height="2" fill="currentColor" />
                </svg>
            </a>
        </div>

        <!-- Day Headers -->
        <!-- <div class="row g-2 mb-2">
            @foreach($days as $day)
            <div class="col text-center">
                <span class="font-pixel small text-muted-foreground">{{ $day }}</span>
            </div>
            @endforeach
        </div> -->

        <div class="calendar-grid calendar-header mb-2">
            @foreach($days as $day)
                <div class="calendar-header-cell font-pixel small text-muted-foreground text-center">
                    {{ $day }}
                </div>
            @endforeach
        </div>

        <!-- Calendar Grid -->
        <div class="calendar-grid">
            @php
                $totalCells = 42;
                $currentCell = 0;
            @endphp

            {{-- Empty sebelum tanggal 1 --}}
            @for($i = 0; $i < $firstDayOfMonth; $i++)
                <div class="calendar-day soil-tile opacity-25"></div>
                @php $currentCell++; @endphp
            @endfor

            {{-- Tanggal --}}
            @for($day = 1; $day <= $daysInMonth; $day++)
                @php
                    $hasEntry = $entriesByDay->has($day);
                    $isToday = $isCurrentMonth && $day === $todayDate;
                    $entryCount = $hasEntry ? $entriesByDay->get($day)->count() : 0;
                    $entries = $hasEntry ? $entriesByDay->get($day)->toArray() : [];
                @endphp

                <div
                    class="calendar-day d-flex flex-column align-items-center justify-content-center p-1
                        {{ $isToday ? 'calendar-day-today' : 'soil-tile' }}
                        {{ $hasEntry ? 'cursor-pointer' : '' }}"
                    @if($hasEntry)
                        onclick="openModal('{{ $year }}-{{ str_pad($month,2,'0',STR_PAD_LEFT) }}-{{ str_pad($day,2,'0',STR_PAD_LEFT) }}', {{ json_encode($entries) }})"
                    @endif
                >
                    <span class="font-pixel small {{ $isToday ? 'text-wood fw-bold' : 'text-cream-80' }}">
                        {{ $day }}
                    </span>

                    @if($hasEntry)
                        <div class="position-relative">
                            @include('partials.pixel-flower', [
                                'mood' => $getDecorativeFlowerMood($day, $month),
                                'size' => 'sm'
                            ])

                            @if($entryCount > 1)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-coral font-pixel"
                                    style="font-size: 0.5rem;">
                                    {{ $entryCount }}
                                </span>
                            @endif
                        </div>
                    @endif
                </div>

                @php $currentCell++; @endphp
            @endfor

            {{-- Empty setelah akhir bulan --}}
            @for($i = $currentCell; $i < $totalCells; $i++)
                <div class="calendar-day soil-tile opacity-25"></div>
            @endfor
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-12 col-lg-4 mt-4 mt-lg-0">
        @if(!($isFriendGarden ?? false))
        <!-- Streak -->
        <div class="pixel-card bg-gold-20 border-gold mb-4">
            <h3 class="font-pixel small text-gold mb-2">Growth Streak</h3>
            <div class="d-flex align-items-center gap-2">
                <span class="font-pixel fs-3 text-wood">{{ $streak }}</span>
                <span class="font-body small text-muted-foreground">day{{ $streak !== 1 ? 's' : '' }}</span>
            </div>
            <p class="font-body small text-muted-foreground mt-2 mb-0">
                {{ $streak >= 7 ? '🌟 Amazing streak!' : ($streak > 0 ? '🌱 Keep growing!' : 'Start journaling today!') }}
            </p>
            <div class="mt-3 d-flex gap-1">
                @for($i = 0; $i < 7; $i++)
                <div class="streak-dot {{ $i < $streak ? 'active' : '' }}"></div>
                @endfor
            </div>
        </div>
        @endif

        <!-- Decorative Watering Can -->
        <div class="text-center mb-4">
            <div class="d-inline-block p-4 rounded-3 animate-float" style="background-color: rgba(248, 202, 185, 0.3);">
                @include('partials.pixel-icons', ['icon' => 'watering-can', 'size' => 64])
            </div>
        </div>

        <!-- Stats -->
        <div class="pixel-card bg-cream">
            <h3 class="font-pixel small text-gold mb-3">This Month</h3>
            <div class="font-body small">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted-foreground">Days Journaled:</span>
                    <span class="fw-semibold">{{ $entriesByDay->count() }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted-foreground">Common Feeling:</span>
                    <span class="fw-semibold">{{ $commonMood }}</span>
                </div>
            </div>
        </div>
    </div>
</div>