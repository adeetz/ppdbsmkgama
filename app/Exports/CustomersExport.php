<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExport implements FromCollection, WithHeadings
{
    /**
     * Return a collection of customers.
     */
    public function collection()
    {
        return Customer::select('nama_lengkap', 'no_hp', 'asal_sekolah', 'tgl_daftar')->get();
    }

    /**
     * Set the header for the excel file.
     */
    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'No HP/WA',
            'Asal Sekolah',
            'Tanggal Daftar',
        ];
    }
}
