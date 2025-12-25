<nav class="navbar navbar-expand-lg fixed-top navbar-bloom">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('landing') }}">
            <span class="font-pixel text-wood me-1">Bloom</span>
            @include('partials.pixel-flower', ['mood' => 'happy', 'size' => 'sm'])
            <span class="font-pixel text-wood ms-1">Together</span>
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                @auth
                    <li class="nav-item">
                        <a class="nav-link nav-link-bloom {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-bloom {{ request()->routeIs('journal') ? 'active' : '' }}" href="{{ route('journal') }}">Journal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-bloom {{ request()->routeIs('garden') ? 'active' : '' }}" href="{{ route('garden') }}">Garden</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-bloom {{ request()->routeIs('friendlist*') ? 'active' : '' }}" href="{{ route('friendlist') }}">Friends</a>
                    </li>
                    
                    <!-- Profile Dropdown -->
                    <li class="nav-item dropdown ms-2">
                        <a class="nav-link dropdown-toggle d-flex align-items-center profile-dropdown" href="#" role="button" data-bs-toggle="dropdown">
                            @include('partials.pixel-profile', ['size' => 28])
                            <span class="font-body text-wood ms-2 d-none d-md-inline">{{ auth()->user()->first_name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-bloom">
                            <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-coral">
                                        <svg class="me-2" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link nav-link-bloom" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-bloom ms-2" href="{{ route('login') }}">Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>