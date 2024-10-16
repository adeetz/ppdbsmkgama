<div>
    @if (!Request::is('login') && !Request::is('daftarsiswa'))
    <!-- Navbar dengan Material Design -->
    <nav class="navbar navbar-expand-lg" style="background-color: #ffffff; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/datasiswa" style="color: #6200ea; font-weight: bold; font-size: 1.5rem;">
                <img src="{{ asset('assets/img/logokecil.webp') }}" alt="Logo" class="rounded-circle me-2" style="width: 40px; height: 40px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="border-color: #6200ea;">
                <span class="navbar-toggler-icon" style="color: #6200ea;"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a wire:navigate class="nav-link {{ Request::is('datasiswa') ? 'active' : '' }}" href="/datasiswa" 
                            style="color: #6200ea; font-weight: 500; padding: 10px 15px; border-radius: 4px; transition: background-color 0.3s, box-shadow 0.3s;">
                            Data Siswa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('users') ? 'active' : '' }}" href="/users" 
                            style="color: #6200ea; font-weight: 500; padding: 10px 15px; border-radius: 4px; transition: background-color 0.3s, box-shadow 0.3s;">
                            User Admin
                        </a>
                    </li>
                </ul>
                
                <style>
                    .nav-link:hover {
                        background-color: rgba(98, 0, 234, 0.1); /* Background with transparency */
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Soft shadow */
                        color: #311b92; /* Darker purple for hover */
                    }
                </style>
                

                <button wire:click="logout" class="btn btn-primary ms-lg-3 ripple" style="border-radius: 25px; background-color: #3d51e7; color: white; font-weight: bold; padding: 10px 20px; box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out me-1">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" x2="9" y1="12" y2="12"/>
                    </svg>
                    Logout
                </button>
            </div>
        </div>
    </nav>
    @endif
</div>
