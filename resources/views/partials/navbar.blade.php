<nav class="navbar navbar-expand-lg fixed-top navbar-bloom">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('landing') }}">
            <span class="font-pixel text-wood me-1">Bloom</span>
            @include('partials.pixel-flower', ['mood' => 'happy', 'size' => 'sm'])
            <span class="font-pixel text-wood ms-1">Together</span>
        </a>

        <!-- Mobile Toggle -->
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">

                @auth
                    <li class="nav-item">
                        <a class="nav-link nav-link-bloom {{ request()->routeIs('home') ? 'active' : '' }}"
                           href="{{ route('home') }}">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link nav-link-bloom {{ request()->routeIs('journal') ? 'active' : '' }}"
                           href="{{ route('journal') }}">Journal</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link nav-link-bloom {{ request()->routeIs('garden') ? 'active' : '' }}"
                           href="{{ route('garden') }}">Garden</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link nav-link-bloom {{ request()->routeIs('friendlist*') ? 'active' : '' }}"
                           href="{{ route('friendlist') }}">Friends</a>
                    </li>

                    <!-- Profile + Dropdown -->
                    <li class="nav-item dropdown ms-2 d-flex align-items-center">

                        <!-- Avatar / Name → PROFILE PAGE -->
                        <a href="{{ route('profile') }}"
                           class="nav-link d-flex align-items-center profile-link">

                            @include('partials.pixel-profile', ['size' => 28])
                            <span class="font-body text-wood ms-2 d-none d-md-inline">
                                {{ auth()->user()->first_name }}
                            </span>
                        </a>

                        <!-- Caret → DROPDOWN -->
                        <button
                            class="btn btn-link nav-link dropdown-toggle dropdown-toggle-split profile-caret"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>

                        <!-- Dropdown Menu -->
                        <ul class="dropdown-menu dropdown-menu-end dropdown-bloom">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    Profile
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-coral">
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
