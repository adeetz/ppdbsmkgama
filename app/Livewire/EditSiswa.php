<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer;

class EditSiswa extends Component
{
    public $customer; // Properti customer yang menyimpan model Customer
    public $nama_lengkap;
    public $no_hp;
    public $asal_sekolah;
    public $tgl_daftar;

    // Method mount untuk inisialisasi berdasarkan customer
    public function mount(Customer $customer)
    {
        $this->customer = $customer; // Simpan model Customer
        $this->nama_lengkap = $customer->nama_lengkap;
        $this->no_hp = $customer->no_hp;
        $this->asal_sekolah = $customer->asal_sekolah;
        $this->tgl_daftar = $customer->tgl_daftar;
    }

    // Render view
    public function render()
    {
        return view('livewire.edit-siswa');
    }

    // Method untuk mengupdate data siswa
    public function updateSiswa()
    {
        // Validasi input
        $validated = $this->validate([
            'nama_lengkap' => 'required|max:255',
            'no_hp'        => 'required|max:20',
            'asal_sekolah' => 'required|max:50',
            'tgl_daftar'   => 'required|date',
        ]);

        // Update data customer langsung dari model yang disimpan
        $this->customer->update($validated);

        // Set flash message
        session()->flash('success', 'Data siswa berhasil diupdate');

        // Redirect ke halaman daftar siswa setelah update
        return redirect()->to('/datasiswa');
    }
}
