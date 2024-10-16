<div>
    <div class="card offset-md-3 col-md-6 mt-5 shadow-sm">
      <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Update Data Siswa Baru</h4>
      </div>
      <div class="card-body p-4">
        <form wire:submit.prevent='updateSiswa'>
          <!-- Form elements -->
               <!-- Nama Lengkap -->
        <div class="mb-4">
          <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
          <input wire:model="nama_lengkap" type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
          <div class="form-text">Isi sesuai Akta Kelahiran</div>
          @error('nama_lengkap')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
  
        <!-- No HP -->
        <div class="mb-4">
          <label for="no_hp" class="form-label">No HP/WA</label>
          <input wire:model="no_hp" type="text" class="form-control" id="no_hp" name="no_hp" required>
          <div class="form-text">Nomor yang aktif dan bisa dihubungi.</div>
          @error('no_hp')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
  
        <!-- Asal Sekolah -->
        <div class="mb-4">
          <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
          <input wire:model="asal_sekolah" type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" required>
          <div class="form-text">Nama sekolah sebelumnya.</div>
          @error('asal_sekolah')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
  
        <!-- Tanggal Daftar -->
        <div class="mb-4">
          <label for="tgl_daftar" class="form-label">Tanggal Daftar</label>
          <input wire:model="tgl_daftar" type="date" class="form-control" id="tgl_daftar" name="tgl_daftar" required>
          @error('tgl_daftar')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
  
        <!-- Submit Button -->
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-success btn-lg">Edit</button>
        </div>
        </form>
      </div>
    </div>
  
    <footer class="mt-5 pt-5">
      <!-- Konten footer -->
    </footer>
  </div>
  