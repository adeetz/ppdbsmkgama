<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Customer;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SiswaExport;
use Livewire\Attributes\On; 

class DataSiswa extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $showModal = false;
    public $selectAll = false;
    public $selectData_id = [];
    
    public $customerId;
    public $nama_lengkap;
    public $no_hp;
    public $asal_sekolah;
    public $tgl_daftar;

    protected $listeners = [
        'hapusSiswa',
        'hapusSelectedData',
        'openModal'
    ];

    public function mount()
    {
        $this->search = '';
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function downloadExcel()
    {
        return Excel::download(new SiswaExport, 'data-siswa.xlsx');
    }

    public function render()
    {
        $customers = Customer::query()
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('nama_lengkap', 'like', '%' . $this->search . '%')
                      ->orWhere('no_hp', 'like', '%' . $this->search . '%')
                      ->orWhere('asal_sekolah', 'like', '%' . $this->search . '%')
                      ->orWhere('tgl_daftar', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.data-siswa', [
            'customers' => $customers
        ]);
    }

    public function openModal($id = null)
    {
        $this->showModal = true;
        
        if ($id) {
            $this->customerId = $id;
            $customer = Customer::find($id);
            
            if ($customer) {
                $this->nama_lengkap = $customer->nama_lengkap;
                $this->no_hp = $customer->no_hp;
                $this->asal_sekolah = $customer->asal_sekolah;
                $this->tgl_daftar = $customer->tgl_daftar;
            }
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->customerId = null;
        $this->nama_lengkap = '';
        $this->no_hp = '';
        $this->asal_sekolah = '';
        $this->tgl_daftar = '';
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updateSiswa()
    {
        $this->validate([
            'nama_lengkap' => 'required|min:3',
            'no_hp' => 'required',
            'asal_sekolah' => 'required',
            'tgl_daftar' => 'required|date',
        ], [
            'nama_lengkap.required' => 'Nama lengkap harus diisi',
            'nama_lengkap.min' => 'Nama lengkap minimal 3 karakter',
            'no_hp.required' => 'Nomor HP harus diisi',
            'asal_sekolah.required' => 'Asal sekolah harus diisi',
            'tgl_daftar.required' => 'Tanggal daftar harus diisi',
            'tgl_daftar.date' => 'Format tanggal tidak valid',
        ]);

        try {
            $customer = Customer::find($this->customerId);
            if ($customer) {
                $customer->update([
                    'nama_lengkap' => $this->nama_lengkap,
                    'no_hp' => $this->no_hp,
                    'asal_sekolah' => $this->asal_sekolah,
                    'tgl_daftar' => $this->tgl_daftar,
                ]);

                $this->dispatch('showSuccess', 'Data siswa berhasil diperbarui');
                $this->closeModal();
            }
        } catch (\Exception $e) {
            $this->dispatch('showError', 'Terjadi kesalahan saat memperbarui data');
        }
    }

    public function hapusSiswa($id)
    {
        try {
            $customer = Customer::find($id);
            if ($customer) {
                $customer->delete();
                $this->dispatch('showSuccess', 'Data siswa berhasil dihapus');
            }
        } catch (\Exception $e) {
            $this->dispatch('showError', 'Terjadi kesalahan saat menghapus data');
        }
    }

    public function hapusSelectedData()
    {
        if (empty($this->selectData_id)) {
            $this->dispatch('showError', 'Pilih data yang akan dihapus terlebih dahulu');
            return;
        }

        try {
            Customer::whereIn('id', $this->selectData_id)->delete();
            $this->selectData_id = [];
            $this->selectAll = false;
            $this->dispatch('showSuccess', 'Data terpilih berhasil dihapus');
        } catch (\Exception $e) {
            $this->dispatch('showError', 'Terjadi kesalahan saat menghapus data');
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectData_id = Customer::pluck('id')->map(fn($id) => (string) $id);
        } else {
            $this->selectData_id = [];
        }
    }
}