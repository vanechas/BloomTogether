<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Bloom Together') }} - @yield('title', 'A Cozy Mental Health Journey')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Nunito:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vite-built CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    @stack('styles')
</head>
<body>
    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Toast Notifications -->
    @if(session('success'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="successToast" class="toast show pixel-card bg-green text-cream">
                <div class="toast-body">{{ session('success') }}</div>
            </div>
        </div>
        <script>
            setTimeout(() => document.getElementById('successToast')?.remove(), 3000);
        </script>
    @endif

    @if($errors->any())
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="errorToast" class="toast show pixel-card bg-coral text-cream">
                <div class="toast-body">{{ $errors->first() }}</div>
            </div>
        </div>
        <script>
            setTimeout(() => document.getElementById('errorToast')?.remove(), 4000);
        </script>
    @endif

    @stack('scripts')
</body>
</html>
