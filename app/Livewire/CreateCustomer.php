<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer; // Model Customer yang benar

class CreateCustomer extends Component
{
    public $nama_lengkap = '';
    public $no_hp = '';
    public $asal_sekolah = '';
    public $tgl_daftar = '';

    public function render()
    {
        return view('livewire.create-customer');
    }

    public function daftar()
    {
        // Validasi input form dengan pesan error kustom
        $validated = $this->validate([
            'nama_lengkap' => 'required|max:255',
            'no_hp'        => 'required|unique:customers|max:20',
            'asal_sekolah' => 'required|max:50',
            'tgl_daftar'   => 'required|date',
        ], [
            'no_hp.unique' => 'Nomor HP ini sudah terdaftar, gunakan nomor lain.',
        ]);

        // Simpan data ke database
        Customer::create($validated); 
        // $this->reset(); // Reset input setelah berhasil menyimpan
        session()->flash('success', 'Kamu berhasil mendaftar tunggu admin SMK GAMA Menguhubungi kamu lewat whatsapp');

        // Redirect setelah update berhasil
        return redirect()->to('/daftarsiswa'); // Redirect yang benar

    }
}
