<div>
    <div class="container my-4 p-4"
        style="background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">

        <!-- Tombol Tambah Data -->
      <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Data Calon Siswa Baru</h4>
            <button wire:click="downloadExcel" class="btn btn-success btn-sm" style="display: flex; align-items: center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-download" style="margin-right: 5px;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="M7 10l5 5 5-5"/><path d="M12 15V3"/></svg>
                Download Excel
            </button>
        </div>
        <!-- Input Pencarian -->
        <div class="mb-3">
            <input wire:model.live.debounce.debounce.150ms="search" type="text" class="form-control"
                placeholder="Cari nama, nomor HP, sekolah, atau tanggal daftar..." style="border-radius: 20px;">
        </div>

        <!-- Flash Message -->
        <livewire:flash-message></livewire:flash-message>

        @if (count($selectData_id) > 0)
            <a href="javascript:void(0);" onclick="confirmDeletionSelected()" class="btn btn-danger btn-sm mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg> Hapus {{ count($selectData_id) }} data
            </a>
        @endif

        <!-- Tabel Data -->
        <table class="table table-striped table-hover"
            style="background-color: white; border-radius: 8px; overflow: hidden;">
            <thead class="thead-light">
                <tr>
                    <th></th>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>No HP/WA</th>
                    <th>Asal Sekolah</th>
                    <th>Tanggal Daftar</th>
                    <th style="width: 150px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customers as $customer)
                    <tr>
                        <td><input type="checkbox" wire:key="{{ $customer->id }}" value="{{ $customer->id }}"
                                wire:model.live='selectData_id'></td>
                        <td>{{ ($customers->currentPage() - 1) * $customers->perPage() + $loop->iteration }}</td>
                        <td>{{ $customer->nama_lengkap }}</td>
                        <td>{{ $customer->no_hp }}</td>
                        <td>{{ $customer->asal_sekolah }}</td>
                        <td>{{ \Carbon\Carbon::parse($customer->tgl_daftar)->translatedFormat('d F Y') }}</td>
                        <td class="d-flex">
                            <button wire:click="openModal({{ $customer->id }})" class="btn btn-secondary btn-edit me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                            </button>

                            <button onclick="confirmDeletion({{ $customer->id }})" class="btn btn-danger btn-delete"
                                style="display: flex; align-items: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-delete"><path d="M10 5a2 2 0 0 0-1.344.519l-6.328 5.74a1 1 0 0 0 0 1.481l6.328 5.741A2 2 0 0 0 10 19h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2z"/><path d="m12 9 6 6"/><path d="m18 9-6 6"/></svg>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Data tidak ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Modal Edit Siswa -->
        <div class="modal fade {{ $showModal ? 'show' : '' }}" style="{{ $showModal ? 'display: block;' : 'display: none;' }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content p-4">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Data Siswa</h5>
                        <button type="button" class="btn-close" aria-label="Close" wire:click="$set('showModal', false)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-x"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent='updateSiswa'>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group form-floating">
                                        <input wire:model="nama_lengkap" type="text" class="form-control" id="nama_lengkap" placeholder="Nama Lengkap" required>
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                        @error('nama_lengkap') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-floating">
                                        <input wire:model="no_hp" type="text" class="form-control" id="no_hp" placeholder="No HP/WA" required>
                                        <label for="no_hp">No HP/WA</label>
                                        @error('no_hp') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
        
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group form-floating">
                                        <input wire:model="asal_sekolah" type="text" class="form-control" id="asal_sekolah" placeholder="Asal Sekolah" required>
                                        <label for="asal_sekolah">Asal Sekolah</label>
                                        @error('asal_sekolah') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-floating">
                                        <input wire:model="tgl_daftar" type="date" class="form-control" id="tgl_daftar" placeholder="Tanggal Daftar" required>
                                        <label for="tgl_daftar">Tanggal Daftar</label>
                                        @error('tgl_daftar') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
        
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $customers->links() }}
        </div>
    </div>

    <!-- SweetAlert Script -->
    <script>
        function confirmDeletion(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('hapusSiswa', id);
                    Swal.fire('Terhapus!', 'Data siswa berhasil dihapus.', 'success');
                }
            });
        }

        function confirmDeletionSelected() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('hapusSelectedData');
                    Swal.fire('Terhapus!', 'Data siswa berhasil dihapus.', 'success');
                }
            });
        }
    </script>
</div>
