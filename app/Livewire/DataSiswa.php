<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;
use App\Exports\CustomersExport;
use Maatwebsite\Excel\Facades\Excel;


class DataSiswa extends Component
{
    use WithPagination;

    public $search = '';
    public $selectData_id = []; // Menyimpan data ID yang dipilih
    public $selectAll = false; // Menyimpan status checkbox select all
    protected $paginationTheme = 'bootstrap';
    public $showModal = false; // Menampilkan modal
    public $selectedCustomer; // ID customer yang sedang diedit
    public $nama_lengkap, $no_hp, $asal_sekolah, $tgl_daftar;

    public function downloadExcel()
    {
        $timestamp = now()->format('Ymd_His'); // Format: TahunBulanHari_JamMenitDetik
        $fileName = 'datacalonsiswabaru_' . $timestamp . '.xlsx';
    
        return Excel::download(new CustomersExport, $fileName);
    }

    // Mendapatkan data customer dengan pencarian dan pagination
    public function getCustomersProperty()
    {
        return Customer::where('nama_lengkap', 'like', '%' . $this->search . '%')
            ->orWhere('no_hp', 'like', '%' . $this->search . '%')
            ->orWhere('asal_sekolah', 'like', '%' . $this->search . '%')
            ->orWhere('tgl_daftar', 'like', '%' . $this->search . '%')
            ->paginate(10);
    }

    // Fungsi untuk checkbox "select all"
    public function updatedSelectAll($value)
    {
        if ($value) {
            // Hanya memilih data di halaman saat ini
            $this->selectData_id = $this->customers->pluck('id')->toArray();
        } else {
            // Jika "select all" dinonaktifkan, kosongkan pilihan
            $this->selectData_id = [];
        }
    }

    // Fungsi untuk reset pilihan saat berpindah halaman
    public function updatedPage()
    {
        $this->selectAll = false; // Reset select all saat pindah halaman
        $this->selectData_id = []; // Kosongkan pilihan saat pindah halaman
    }

    // Fungsi untuk menghapus data yang dipilih
    public function hapusSiswa($id)
    {
        // Menghapus siswa berdasarkan ID
        $customer = Customer::find($id);

        if ($customer) {
            $customer->delete();
            session()->flash('success', 'Data siswa berhasil dihapus');
        } else {
            session()->flash('error', 'Data siswa tidak ditemukan');
        }
        
        // Redirect ke halaman data siswa
        return redirect('/datasiswa');
    }

    public function hapusSelectedData()
    {
        if (count($this->selectData_id) > 0) {
            Customer::whereIn('id', $this->selectData_id)->delete();
            session()->flash('success', count($this->selectData_id) . ' data berhasil dihapus');
            $this->selectData_id = []; // Reset setelah penghapusan
            
            // Redirect atau refresh halaman setelah penghapusan
            return redirect()->route('datasiswa');
        } else {
            session()->flash('error', 'Tidak ada data yang dipilih untuk dihapus');
        }
    }

    // Fungsi untuk membuka modal dan memuat data customer
    public function openModal($customerId)
    {
        $customer = Customer::find($customerId);
        if ($customer) {
            $this->selectedCustomer = $customer->id;
            $this->nama_lengkap = $customer->nama_lengkap;
            $this->no_hp = $customer->no_hp;
            $this->asal_sekolah = $customer->asal_sekolah;
            $this->tgl_daftar = $customer->tgl_daftar;
            $this->showModal = true; // Tampilkan modal
        }
    }

    // Fungsi untuk memperbarui data siswa
    public function updateSiswa()
{
    // Cari customer berdasarkan ID yang dipilih
    $customer = Customer::find($this->selectedCustomer);
    
    if ($customer) {
        // Update atribut customer
        $customer->nama_lengkap = $this->nama_lengkap;
        $customer->no_hp = $this->no_hp;
        $customer->asal_sekolah = $this->asal_sekolah;
        $customer->tgl_daftar = $this->tgl_daftar;

        // Simpan perubahan
        if ($customer->save()) {
            session()->flash('success', 'Data siswa berhasil diperbarui');
        } else {
            session()->flash('error', 'Gagal memperbarui data siswa');
        }
    } else {
        session()->flash('error', 'Data siswa tidak ditemukan');
    }
    
    // Tutup modal
    $this->showModal = false; 
    
    // Redirect ke halaman data siswa jika diperlukan
    return redirect('/datasiswa');
}


    public function render()
    {
        return view('livewire.data-siswa', ['customers' => $this->customers]);
    }
}
