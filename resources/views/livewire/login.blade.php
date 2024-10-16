<div class="d-flex align-items-center justify-content-center vh-100" style="background: linear-gradient(135deg, #f0f0f0 0%, #cfd9df 100%);">
    <div class="card shadow-lg border-0" style="width: 24rem; border-radius: 20px;">
        <div class="card-body p-4">
            <h2 class="text-center mb-4 text-primary fw-bold">Login Bang</h2>
            <p class="text-center text-muted mb-4">smkgama.sch.id</p>

            @if (session()->has('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif

            <form wire:submit.prevent="login" class="animate__animated animate__fadeIn">
                <div class="form-group mb-3">
                    <label for="email" class="form-label text-muted">Email Address</label>
                    <input type="email" id="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email">
                    @error('email') 
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="password" class="form-label text-muted">Password</label>
                    <input type="password" id="password" wire:model="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password">
                    @error('password') 
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100 btn-lg shadow-sm" style="border-radius: 50px;">Login</button>
            </form>

            <div class="text-center mt-3">
                <small class="text-muted">created by M. Noor Aditya Rahman</small>
            </div>
        </div>
    </div>
</div>
