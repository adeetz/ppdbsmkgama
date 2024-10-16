<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User; // Pastikan Anda sudah mengimpor model User
use Illuminate\Support\Facades\Hash; // Untuk hashing password
use Illuminate\Support\Facades\Auth; // Untuk login

class Register extends Component
{
    public $name; // Mengganti $nama dengan $name
    public $email;
    public $password;
    
    public function render()
    {
        return view('livewire.register');
    }

    public function storeUser()
    {
        // Validasi input
        $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:5|max:255'
        ]);
    
        // Debugging: Tampilkan data yang akan disimpan
        // dd($this->name, $this->email, $this->password);
    
        // Simpan pengguna ke database
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
    
        // Menampilkan pesan sukses
        session()->flash('success', 'User berhasil ditambahkan!');
    
        // Reset input
        $this->reset(['name', 'email', 'password']);
    
        // Login pengguna setelah pendaftaran
        Auth::attempt(['email' => $this->email, 'password' => $this->password]);
    
        session()->flash('success', 'Pendaftaran berhasil!');
        return redirect()->to('/users');
    }
    
}
