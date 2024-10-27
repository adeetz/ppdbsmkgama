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

        <!-- Tabel Data -->
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
                @foreach ($users as $user)
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
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>