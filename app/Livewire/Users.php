<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    // Tambahkan listener untuk event deleteUser
    protected $listeners = ['deleteUser' => 'hapusUser'];

    public function render()
    {
        $users = User::paginate(10);
        return view('livewire.users', ['users' => $users]);
    }

    public function confirmDelete($id)
    {
        $this->dispatch('swal:confirm', [
            'type' => 'warning',  
            'title' => 'Yakin ingin menghapus?',
            'text' => 'Data yang dihapus tidak dapat dikembalikan!',
            'id' => $id
        ]);
    }

    public function hapusUser($id)
{
    $user = User::find($id);
    if ($user) {
        $user->delete();
        session()->flash('success', 'Data pengguna berhasil dihapus.');
    }
}
}