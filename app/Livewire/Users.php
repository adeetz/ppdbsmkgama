<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User; // Pastikan model User diimpor
use Livewire\WithPagination; // Menggunakan fitur paginasi Livewire

class Users extends Component
{
    use WithPagination; // Menerapkan fitur paginasi ke komponen Livewire

    public function render()
    {
        // Menggunakan paginate() untuk mendapatkan data dengan paginasi
        $users = User::paginate(10); // Ganti 10 dengan jumlah item per halaman yang diinginkan

        return view('livewire.users', ['users' => $users]);
    }

    public function hapusUser($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            session()->flash('success', 'Data pengguna berhasil dihapus.');
        } else {
            session()->flash('error', 'Data pengguna tidak ditemukan.');
        }

        return redirect()->to('/users');
    }
}
