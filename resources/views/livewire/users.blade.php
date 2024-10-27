<div>
    <!-- Container -->
    <div class="container my-4 p-4"
        style="background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
        <!-- Judul dan Tombol Tambah Data -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Pengguna</h4>
            <a href="{{ route('users.create') }}" class="btn btn-success btn-sm" style="border-radius: 20px;">
                <ion-icon name="add" style="font-size: 18px; margin-right: 5px;"></ion-icon>
                Tambah User
            </a>
        </div>

        <!-- Flash Message -->
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Tabel Data -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <button wire:click="confirmDelete({{ $user->id }})" class="btn btn-danger btn-sm">
                                    <ion-icon name="trash-bin-sharp" style="font-size: 18px; margin-right: 5px;"></ion-icon>
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-3">Tidak ada data pengguna</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>

@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('swal:confirm', (data) => {
            Swal.fire({
                title: data[0].title,
                text: data[0].text,
                icon: data[0].type,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Dispatch event ke Livewire
                    @this.hapusUser(data[0].id);
                    
                    // Tampilkan pesan sukses
                    Swal.fire({
                        icon: 'success',
                        title: 'Terhapus!',
                        text: 'Data pengguna berhasil dihapus.',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });
        });
    });
</script>
@endpush