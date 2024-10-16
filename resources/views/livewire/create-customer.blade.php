<div>
  <div class="container-fluid" style="background-color: #f4f7f6; min-height: 100vh; padding-top: 100px;">
    <livewire:flash-message></livewire:flash-message>

    <div class="row justify-content-center">
      <div class="card col-md-6 col-lg-5 col-sm-8 mt-5 shadow-lg border-0" style="border-radius: 12px; overflow: hidden;">
        <div class="card-header bg-primary text-white text-center" style="padding: 20px 15px; border-radius: 0 0 50px 50px;">
          <h4 class="mb-1" style="font-family: 'Poppins', sans-serif;">Pendaftaran Siswa Baru</h4>
          <p class="mb-0" style="font-size: 0.95rem;">Isi form pendaftaran dengan benar</p>
        </div>

        <div class="card-body p-4" style="background-color: #ffffff;">
          <form wire:submit.prevent='daftar'>
            <!-- Nama Lengkap -->
            <div class="mb-4 md-form">
              <input wire:model="nama_lengkap" type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required placeholder=" " style="border-radius: 0;">
              <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
              <div class="form-text">Isi sesuai Akta Kelahiran</div>
              @error('nama_lengkap')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <!-- No HP -->
            <div class="mb-4 md-form">
              <input wire:model="no_hp" type="text" class="form-control" id="no_hp" name="no_hp" required placeholder=" " style="border-radius: 0;">
              <label for="no_hp" class="form-label">No HP/WA</label>
              <div class="form-text">Nomor yang aktif dan bisa dihubungi.</div>
              @error('no_hp')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <!-- Asal Sekolah -->
            <div class="mb-4 md-form">
              <input wire:model="asal_sekolah" type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" required placeholder=" " style="border-radius: 0;">
              <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
              <div class="form-text">Nama sekolah sebelumnya.</div>
              @error('asal_sekolah')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <!-- Tanggal Daftar -->
            <div class="mb-4 md-form">
              <input wire:model="tgl_daftar" type="date" class="form-control" id="tgl_daftar" name="tgl_daftar" required style="border-radius: 0;">
              <label for="tgl_daftar" class="form-label">Tanggal Daftar</label>
              @error('tgl_daftar')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <!-- Submit Button -->
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-success btn-lg" style="border-radius: 50px; display: flex; align-items: center; justify-content: center;">
                <ion-icon name="school-outline" style="font-size: 20px; margin-right: 8px;"></ion-icon>
                Daftar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <footer class="text-center mt-5 pt-4">
      <small style="color: #6c757d;">&copy; 2024 SMK GARUDA Mahadhika. All Rights Reserved.</small>
    </footer>
  </div>

  <style>
    
  </style>
</div>
