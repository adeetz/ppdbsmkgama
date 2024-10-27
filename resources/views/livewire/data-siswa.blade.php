<div>
    <div class="container my-4 p-4" style="background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Data Calon Siswa Baru</h4>
            <button wire:click="downloadExcel" class="btn btn-success btn-sm" style="display: flex; align-items: center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="me-2">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <path d="M7 10l5 5 5-5"/>
                    <path d="M12 15V3"/>
                </svg>
                Download Excel
            </button>
        </div>

        <!-- Search Input -->
        <div class="mb-3">
            <input 
                wire:model.live.debounce.300ms="search"
                type="text" 
                class="form-control" 
                placeholder="Cari nama, nomor HP, sekolah, atau tanggal daftar..." 
                style="border-radius: 20px;">
        </div>

        <!-- Flash Messages -->
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Bulk Delete Button -->
        @if (count($selectData_id) > 0)
            <a href="javascript:void(0);" onclick="confirmDeletionSelected()" class="btn btn-danger btn-sm mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" 
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                     class="me-2">
                    <path d="M3 6h18"/>
                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                </svg>
                Hapus {{ count($selectData_id) }} data
            </a>
        @endif

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-light">
                    <tr>
                        <th><input type="checkbox" wire:model.live="selectAll"></th>
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
                            <td>
                                <input type="checkbox" 
                                       wire:key="{{ $customer->id }}" 
                                       value="{{ $customer->id }}"
                                       wire:model.live="selectData_id">
                            </td>
                            <td>{{ ($customers->currentPage() - 1) * $customers->perPage() + $loop->iteration }}</td>
                            <td>{{ $customer->nama_lengkap }}</td>
                            <td>{{ $customer->no_hp }}</td>
                            <td>{{ $customer->asal_sekolah }}</td>
                            <td>{{ \Carbon\Carbon::parse($customer->tgl_daftar)->translatedFormat('d F Y') }}</td>
                            <td class="d-flex">
                                <button wire:click="openModal({{ $customer->id }})" 
                                        class="btn btn-secondary btn-sm me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" 
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                                         stroke-linejoin="round">
                                        <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/>
                                    </svg>
                                </button>
                                <button onclick="confirmDeletion({{ $customer->id }})" 
                                        class="btn btn-danger btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" 
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                                         stroke-linejoin="round">
                                        <path d="M3 6h18"/>
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                    </svg>
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
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $customers->links() }}
        </div>

        <!-- Edit Modal -->
        @if($showModal)
        <div class="modal show d-block" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Siswa</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit="updateSiswa">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" wire:model="nama_lengkap">
                                    @error('nama_lengkap') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No HP/WA</label>
                                    <input type="text" class="form-control" wire:model="no_hp">
                                    @error('no_hp') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Asal Sekolah</label>
                                    <input type="text" class="form-control" wire:model="asal_sekolah">
                                    @error('asal_sekolah') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Daftar</label>
                                    <input type="date" class="form-control" wire:model="tgl_daftar">
                                    @error('tgl_daftar') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" wire:click="closeModal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
        @endif

        @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // Sweet Alert untuk konfirmasi hapus single data
            function confirmDeletion(id) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('hapusSiswa', { id: id });
                    }
                });
            }

            // Sweet Alert untuk konfirmasi hapus multiple data
            function confirmDeletionSelected() {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Semua data yang dipilih akan dihapus dan tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus semua!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('hapusSelectedData');
                    }
                });
            }

            // Event listener untuk pesan sukses dan error
            document.addEventListener('livewire:initialized', () => {
                Livewire.on('showSuccess', (data) => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data[0],
                        timer: 2000,
                        showConfirmButton: false
                    });
                });

                Livewire.on('showError', (data) => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: data[0],
                        timer: 2000,
                        showConfirmButton: false
                    });
                });
            });
        </script>
        @endpush
    </div>
</div>