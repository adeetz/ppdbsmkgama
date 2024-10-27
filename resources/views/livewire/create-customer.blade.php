<div>
  <div class="container-fluid" style="min-height: 100vh; padding-top: 80px; background-color: #f0f2f5;">
    <livewire:flash-message></livewire:flash-message>

    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5 col-sm-11 mt-4">
        <div class="card border-0 shadow-lg animate-slide-down" 
             style="border-radius: 20px; background: #ffffff; animation: slideDown 0.5s ease-out;">
          <!-- Header with original blue gradient -->
          <div class="card-header border-0 text-white text-center py-4" 
               style="background: linear-gradient(to right, #1a237e, #0d47a1); border-radius: 20px 20px 0 0;">
            <h4 class="mb-1 fw-bold animate-fade-in" 
                style="font-family: system-ui; animation: fadeIn 0.8s ease-out;">
              Pendaftaran Siswa Baru
            </h4>
            <p class="mb-0 opacity-75 animate-fade-in" 
               style="animation: fadeIn 1s ease-out;">
              Isi form pendaftaran dengan benar
            </p>
          </div>

          <!-- Form -->
          <div class="card-body p-4">
            <form wire:submit.prevent='daftar'>
              <!-- Nama Lengkap -->
              <div class="form-floating mb-4 animate-slide-up" 
                   style="animation: slideUp 0.5s ease-out 0.3s both;">
                <input wire:model="nama_lengkap" 
                       type="text" 
                       class="form-control form-control-lg border-0 border-bottom" 
                       id="nama_lengkap" 
                       name="nama_lengkap" 
                       required 
                       placeholder="Nama Lengkap"
                       style="background: transparent; transition: all 0.3s ease;">
                <label for="nama_lengkap" class="text-muted">Nama Lengkap</label>
                <div class="form-text small">Isi sesuai Akta Kelahiran</div>
                @error('nama_lengkap')
                  <span class="text-danger small">{{ $message }}</span>
                @enderror
              </div>

              <!-- No HP -->
              <div class="form-floating mb-4 animate-slide-up" 
                   style="animation: slideUp 0.5s ease-out 0.4s both;">
                <input wire:model="no_hp" 
                       type="text" 
                       class="form-control form-control-lg border-0 border-bottom" 
                       id="no_hp" 
                       name="no_hp" 
                       required 
                       placeholder="No HP/WA"
                       style="background: transparent; transition: all 0.3s ease;">
                <label for="no_hp" class="text-muted">No HP/WA</label>
                <div class="form-text small">Nomor yang aktif dan bisa dihubungi.</div>
                @error('no_hp')
                  <span class="text-danger small">{{ $message }}</span>
                @enderror
              </div>

              <!-- Asal Sekolah -->
              <div class="form-floating mb-4 animate-slide-up" 
                   style="animation: slideUp 0.5s ease-out 0.5s both;">
                <input wire:model="asal_sekolah" 
                       type="text" 
                       class="form-control form-control-lg border-0 border-bottom" 
                       id="asal_sekolah" 
                       name="asal_sekolah" 
                       required 
                       placeholder="Asal Sekolah"
                       style="background: transparent; transition: all 0.3s ease;">
                <label for="asal_sekolah" class="text-muted">Asal Sekolah</label>
                <div class="form-text small">Nama sekolah sebelumnya.</div>
                @error('asal_sekolah')
                  <span class="text-danger small">{{ $message }}</span>
                @enderror
              </div>

              <!-- Tanggal Daftar -->
              <div class="form-floating mb-4 animate-slide-up" 
                   style="animation: slideUp 0.5s ease-out 0.6s both;">
                <input wire:model="tgl_daftar" 
                       type="date" 
                       class="form-control form-control-lg border-0 border-bottom" 
                       id="tgl_daftar" 
                       name="tgl_daftar" 
                       required
                       style="background: transparent; transition: all 0.3s ease;">
                <label for="tgl_daftar" class="text-muted">Tanggal Daftar</label>
                @error('tgl_daftar')
                  <span class="text-danger small">{{ $message }}</span>
                @enderror
              </div>

              <!-- Submit Button with original gradient -->
              <div class="d-grid gap-2 mt-5 animate-slide-up" 
                   style="animation: slideUp 0.5s ease-out 0.7s both;">
                <button type="submit" 
                        class="btn btn-lg py-3" 
                        style="border-radius: 15px; background: linear-gradient(to right, #1565C0, #0D47A1); color: white; border: none; transition: all 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-3px)'" 
                        onmouseout="this.style.transform='translateY(0)'">
                  <ion-icon name="school-outline" 
                          style="font-size: 1.2rem; vertical-align: middle; margin-right: 8px;">
                  </ion-icon>
                  <span class="fw-bold">Daftar Sekarang</span>
                </button>
              </div>
            </form>
          </div>
        </div>

        <!-- Footer -->
        <footer class="text-center mt-4 mb-5 animate-fade-in" 
                style="animation: fadeIn 1s ease-out 1s both;">
          <small class="text-muted">&copy; 2024 SMK GARUDA Mahadhika. All Rights Reserved.</small>
        </footer>
      </div>
    </div>
  </div>

  <style>
    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }

    .form-control:hover {
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .form-control:focus {
      border-bottom: 2px solid #1565C0 !important;
      box-shadow: none !important;
    }

    .card {
      transition: transform 0.3s ease;
    }
    
    .card:hover {
      transform: translateY(-5px);
    }

    body {
      background-color: #f0f2f5;
    }
  </style>
</div>