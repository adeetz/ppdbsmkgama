<div>
    @if (!Request::is('login') && !Request::is('daftarsiswa'))
    <nav class="navbar navbar-expand-lg" style="background-color: #ffffff; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
        <div class="container">
            <!-- Logo dan Brand -->
            <a class="navbar-brand d-flex align-items-center" href="{{ route('datasiswa') }}"
                style="color: #6200ea; font-weight: bold; font-size: 1.5rem;">
                <img src="{{ asset('assets/img/logokecil.webp') }}" alt="Logo" class="rounded-circle me-2"
                    style="width: 40px; height: 40px;">
            </a>

            <!-- Tombol Toggle untuk Mobile -->
            <button class="navbar-toggler" type="button" wire:click="toggleMenu"
                aria-controls="navbarNav" aria-expanded="{{ $isOpen }}" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu Navigasi -->
            <div class="collapse navbar-collapse {{ $isOpen ? 'show' : '' }}" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ route('datasiswa') }}"
                            class="nav-link {{ $currentRoute === 'datasiswa' ? 'active fw-bold' : '' }}"
                            style="color: #6200ea; font-weight: 500; padding: 10px 15px;">
                            Data Siswa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('users') }}"
                            class="nav-link {{ $currentRoute === 'users' ? 'active fw-bold' : '' }}"
                            style="color: #6200ea; font-weight: 500; padding: 10px 15px;">
                            User Admin
                        </a>
                    </li>
                </ul>

                <!-- Tombol Logout -->
                <button type="button" wire:click="logout" class="btn btn-primary ms-lg-3"
                    style="border-radius: 25px; background-color: #3d51e7; border: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-log-out me-1">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" x2="9" y1="12" y2="12" />
                    </svg>
                    Logout
                </button>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @endif
</div>